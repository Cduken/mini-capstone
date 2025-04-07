<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Region;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
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

        // Get all regions for the address dropdowns
        $regions = Region::orderBy('name')->get();

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.1;
        $shipping = 10.00;
        $total = $subtotal + $tax + $shipping;

        // Get full address details from session
        $addressDetails = $this->getFullAddressDetails();

        return view('payment', [
            'regions' => $regions,
            'address' => Session::get('address_line_1'), // Changed from 'address' to 'address_line_1'
            'region' => Session::get('region'),
            'regionName' => $addressDetails['regionName'],
            'province' => Session::get('province'),
            'provinceName' => $addressDetails['provinceName'],
            'city' => Session::get('city'),
            'cityName' => $addressDetails['cityName'],
            'barangay' => Session::get('barangay'),
            'barangayName' => $addressDetails['barangayName'],
            'zip_code' => Session::get('zip_code'),
            'shippingMethod' => Session::get('shipping_method'),
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'order' => null
        ]);
    }

    protected function getFullAddressDetails()
    {
        $regionName = '';
        $provinceName = '';
        $cityName = '';
        $barangayName = '';

        if (Session::has('region')) {
            $region = Region::find(Session::get('region'));
            $regionName = $region ? $region->name : '';
        }

        if (Session::has('province')) {
            $province = Province::find(Session::get('province'));
            $provinceName = $province ? $province->name : '';
        }

        if (Session::has('city')) {
            $city = City::find(Session::get('city'));
            $cityName = $city ? $city->name : '';
        }

        if (Session::has('barangay')) {
            $barangay = Barangay::find(Session::get('barangay'));
            $barangayName = $barangay ? $barangay->name : '';
        }

        return [
            'regionName' => $regionName,
            'provinceName' => $provinceName,
            'cityName' => $cityName,
            'barangayName' => $barangayName
        ];
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'region' => 'required|string|max:10',
            'province' => 'required|string|max:10',
            'city' => 'required|string|max:10',
            'barangay' => 'required|string|max:10',
            'zip_code' => 'required|string|max:10',
            'shipping_method' => 'required|string',
        ]);

        // Get the address details from database
        $region = Region::findOrFail($request->region);
        $province = Province::findOrFail($request->province);
        $city = City::findOrFail($request->city);
        $barangay = Barangay::findOrFail($request->barangay);

        // Save to session
        Session::put('address_line_1', $request->address_line_1); // Changed from 'address' to 'address_line_1'
        Session::put('region', $region->code);
        Session::put('region_name', $region->name);
        Session::put('province', $province->code);
        Session::put('province_name', $province->name);
        Session::put('city', $city->code);
        Session::put('city_name', $city->name);
        Session::put('barangay', $barangay->code);
        Session::put('barangay_name', $barangay->name);
        Session::put('zip_code', $request->zip_code);
        Session::put('shipping_method', $request->shipping_method);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Session::put('cartItems', $cartItems);

        return redirect()->route('payment');
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

            // Get address details
            $region = Region::findOrFail(Session::get('region'));
            $province = Province::findOrFail(Session::get('province'));
            $city = City::findOrFail(Session::get('city'));
            $barangay = Barangay::findOrFail(Session::get('barangay'));

            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $tax = $subtotal * 0.1;
            $shipping = 10.00;
            $total = $subtotal + $tax + $shipping;

            $cartItems = Cart::with('product') // Add this to ensure product is loaded
                ->where('user_id', Auth::id())
                ->get();

            // Prepare order items
            $items = $cartItems->map(function ($cartItem) {
                return [
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->title, // Use ->title instead of ->name if that's your field
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'image' => $cartItem->product->image ?? 'default.jpg' // Ensure default image
                ];
            });

            foreach ($cartItems as $item) {
                if (!$item->product) {
                    throw new \Exception("Product not found for cart item ID: {$item->id}");
                }
                if (empty($item->product->title)) { // or ->name depending on your DB
                    throw new \Exception("Product title is empty for product ID: {$item->product_id}");
                }
            }

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

            // Debug session data before creating order
            Log::debug('Address data from session:', [
                'address_line_1' => Session::get('address_line_1'),
                'region' => $region->name,
                'province' => $province->name,
                'city' => $city->name,
                'barangay' => $barangay->name,
                'zip_code' => Session::get('zip_code')
            ]);

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'address_line_1' => Session::get('address_line_1', 'No address provided'),
                'address_line_2' => null,
                'region' => $region->name,
                'region_code' => $region->code,
                'province' => $province->name,
                'province_code' => $province->code,
                'city' => $city->name,
                'city_code' => $city->code,
                'barangay' => $barangay->name,
                'barangay_code' => $barangay->code,
                'zip_code' => Session::get('zip_code'),
                'shipping_method' => Session::get('shipping_method'),
                'payment_method' => $paymentMethod,
                'payment_details' => $paymentDetails,
                'items' => $items,
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
                'address_line_1',
                'region',
                'province',
                'city',
                'barangay',
                'zip_code',
                'shipping_method',
                'cartItems'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'order' => $order,
                'order_id' => $order->id,
                'redirect_url' => route('purchases.index', $order)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment processing error: ' . $e->getMessage());
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

        $order->load(['products' => function ($query) {
            $query->select('products.id', 'products.title', 'products.image');
        }]);

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

        Session::forget([
            'address_line_1',
            'region',
            'province',
            'city',
            'barangay',
            'zip_code',
            'shipping_method',
            'cartItems'
        ]);

        return response()->json(['success' => true]);
    }

    public function purchases()
    {
        $orders = Order::with(['products' => function ($query) {
            $query->select('products.id', 'products.title', 'products.image'); // Add other needed fields
        }])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('purchases.index', compact('orders'));
    }

    public function cancelOrder(Order $order)
    {
        try {
            // Check if the order belongs to the authenticated user
            if ($order->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            // Check if order can be cancelled
            if (!$order->canBeCancelled()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This order cannot be cancelled. Current status: ' . $order->status
                ], 400);
            }

            // Update order status
            $order->update([
                'status' => 'cancelled',
                'cancelled_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully',
                'order_status' => 'cancelled'
            ]);
        } catch (\Exception $e) {
            Log::error('Order cancellation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order: ' . $e->getMessage()
            ], 500);
        }
    }
}
