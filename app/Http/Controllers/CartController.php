<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Region;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.1;
        $shipping = 10;
        $total = $subtotal + $tax + $shipping;

        // Get regions for address dropdown
        $regions = Region::orderBy('name')->get();

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total',
            'regions'
        ));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $id
        ]);

        // If item already exists, increment quantity, otherwise set to 1
        if ($cartItem->exists) {
            $cartItem->quantity += 1;
        } else {
            $cartItem->quantity = 1;
        }

        $cartItem->price = $product->price;
        $cartItem->save();

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->firstOrFail();

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return $this->getCartResponse($id);
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        return $this->getCartResponse();
    }

    // Address-related methods
    public function getProvinces(Request $request)
    {
        $request->validate(['region_code' => 'required|string']);

        $provinces = Province::where('region_code', $request->region_code)
            ->orderBy('name')
            ->get(['code', 'name']);

        return response()->json($provinces);
    }

    public function getCities(Request $request)
    {
        $request->validate(['province_code' => 'required|string']);

        $cities = City::where('province_code', $request->province_code)
            ->orderBy('name')
            ->get(['code', 'name', 'zip_code']);

        return response()->json($cities);
    }

    public function getBarangays(Request $request)
    {
        $request->validate(['city_code' => 'required|string']);

        $barangays = Barangay::where('city_code', $request->city_code)
            ->orderBy('name')
            ->get(['code', 'name']);

        return response()->json($barangays);
    }

    protected function getCartResponse($productId = null)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $response = [
            'success' => true,
            'quantity' => $cartItems->sum('quantity'),
            'subtotal' => number_format($subtotal, 2),
            'tax' => number_format($subtotal * 0.1, 2),
            'shipping' => number_format(10, 2),
            'total' => number_format($subtotal * 1.1 + 10, 2),
            'item_count' => $cartItems->count()
        ];

        // Add individual item data if product ID is provided
        if ($productId) {
            $item = $cartItems->firstWhere('product_id', $productId);
            if ($item) {
                $response['price'] = number_format($item->price * $item->quantity, 2);
                $response['item_quantity'] = $item->quantity;
            }
        }

        return response()->json($response);
    }
}
