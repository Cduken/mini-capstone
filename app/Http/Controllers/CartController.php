<?php
// filepath: c:\Users\Cduken\Desktop\2nd Sem\Mini Capstone\mini capstone pure laravel\mini-capstone\app\Http\Controllers\CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.1; // Example tax calculation
        $shipping = 10; // Example shipping cost
        $total = $subtotal + $tax + $shipping;

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }





    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price, // Include the price field
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'success' => true,
            'quantity' => $cartItem->quantity,
            'price' => number_format($cartItem->price * $cartItem->quantity, 2),
            'subtotal' => number_format($subtotal, 2),
            'tax' => number_format($subtotal * 0.1, 2),
            'shipping' => number_format(10, 2),
            'total' => number_format($subtotal * 1.1 + 10, 2)
        ]);
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($subtotal * 1.1 + 10, 2)
        ]);
    }
}
