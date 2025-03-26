<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You need to login first'
            ], 401);
        }

        $user = Auth::user();
        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $isWishlisted = false;
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            $isWishlisted = true;
        }

        return response()->json([
            'status' => 'success',
            'isWishlisted' => $isWishlisted,
            'wishlistCount' => $user->wishlists()->count()
        ]);
    }

    public function index()
    {
        $wishlistItems = Auth::user()->wishlistProducts()->with('category')->get();
        return view('wishlist', compact('wishlistItems'));
    }
}
