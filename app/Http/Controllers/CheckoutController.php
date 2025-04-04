<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'shipping_method' => 'required|string',
        ]);

        // Save the address, shipping method, and cart items to the session
        Session::put('address', $request->address_line_1);
        Session::put('city', $request->city);
        Session::put('zip_code', $request->zip_code);
        Session::put('country', $request->country);
        Session::put('state', $request->state);
        Session::put('shipping_method', $request->shipping_method);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Session::put('cartItems', $cartItems);

        // Redirect to the payment page
        return redirect()->route('payment');
    }

    public function showPaymentPage()
    {
        $cartItems = Session::get('cartItems', function () {
            return Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        });

        if (!$cartItems || $cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.1;
        $shipping = 10.00;
        $total = $subtotal + $tax + $shipping;

        return view('payment', [
            'address' => Session::get('address'),
            'city' => Session::get('city'),
            'zip_code' => Session::get('zip_code'),
            'country' => Session::get('country'),
            'state' => Session::get('state'),
            'shippingMethod' => Session::get('shipping_method'),
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'order' => null // Explicitly set order to null for payment page
        ]);
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        // Common validation for all payment methods
        $request->validate([
            'payment_method' => 'required|in:card,gcash,cod'
        ]);

        // Payment method specific validation
        switch ($paymentMethod) {
            case 'card':
                $request->validate([
                    'card_name' => 'required|string|max:255',
                    'card_number' => 'required|numeric',
                    'exp_date' => 'date|required',
                    'cvv' => 'required|numeric',
                ]);
                break;

            case 'gcash':
                $request->validate([
                    'gcash_number' => 'required|string|regex:/^09[0-9]{9}$/',
                    'gcash_name' => 'required|string|max:255',
                ]);
                break;

            case 'cod':
                $request->validate([
                    'cod_confirm' => 'required|accepted',
                ]);
                break;
        }

        DB::beginTransaction();
        try {
            $cartItems = Session::get('cartItems', function () {
                return Cart::with('product')
                    ->where('user_id', Auth::id())
                    ->get();
            });

            if (!$cartItems || $cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty');
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $tax = $subtotal * 0.1;
            $shipping = 10.00;
            $total = $subtotal + $tax + $shipping;

            // Prepare order items
            $items = $cartItems->map(function ($cartItem) {
                return [
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name ?? 'Unknown Product',
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'image' => $cartItem->product->image ?? null
                ];
            });

            // Prepare payment details
            $paymentDetails = [
                'method' => $paymentMethod === 'card' ? 'Credit Card' : ($paymentMethod === 'gcash' ? 'GCash' : 'Cash on Delivery')
            ];

            if ($paymentMethod === 'card') {
                $paymentDetails['last_four'] = substr($request->card_number, -4);
            } elseif ($paymentMethod === 'gcash') {
                $paymentDetails['number'] = $request->gcash_number;
                $paymentDetails['name'] = $request->gcash_name;
            }

            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'address' => Session::get('address'),
                'city' => Session::get('city'),
                'zip_code' => Session::get('zip_code'),
                'country' => Session::get('country'),
                'state' => Session::get('state'),
                'shipping_method' => Session::get('shipping_method'),
                'payment_method' => $paymentMethod,
                'payment_details' => json_encode($paymentDetails),
                'items' => $items->toJson(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'status' => $paymentMethod === 'cod' ? 'pending' : 'completed'
            ]);

            // Attach products to order
            $productsData = [];
            foreach ($cartItems as $item) {
                $productsData[$item->product_id] = [
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ];
            }
            $order->products()->sync($productsData);

            // Clear cart and session
            Cart::where('user_id', Auth::id())->delete();
            Session::forget([
                'address',
                'city',
                'zip_code',
                'country',
                'state',
                'shipping_method',
                'cartItems'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'order' => $order,
                'order_id' => $order->id,
                'products' => $order->products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'image' => asset($product->image),
                        'quantity' => $product->pivot->quantity,
                        'price' => $product->pivot->price,
                        'rating_url' => route('products.rate', $product)
                    ];
                }),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function orderSuccess(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('products'); // Eager load products

        return view('orders.success', [
            'order' => $order,
            'subtotal' => $order->subtotal,
            'shipping' => $order->shipping,
            'tax' => $order->tax,
            'total' => $order->total
        ]);
    }

    public function clearSession()
    {

        Cart::where('user_id', Auth::id())->delete();

        // Clear the session data
        Session::forget('address');
        Session::forget('city');
        Session::forget('zip_code');
        Session::forget('country');
        Session::forget('state');
        Session::forget('shipping_method');
        Session::forget('cartItems');

        return response()->json(['success' => true]);
    }
}
