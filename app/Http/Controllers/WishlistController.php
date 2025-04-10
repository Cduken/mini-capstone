<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->wishlist()->where('product_id', $product->id)->exists()) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);

            return redirect()->back()->with('success', 'Product added to wishlist!');
        }

        return redirect()->back()->with('info', 'Product is already in your wishlist.');
    }

    public function remove(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $wishlistItem = $user->wishlist()->where('product_id', $product->id)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        }

        return redirect()->back()->with('info', 'Product not found in your wishlist.');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $wishlistItems = $user->wishlist()->with('product')->get();

        // Get recommended products (excluding already wishlisted items)
        $wishlistProductIds = $wishlistItems->pluck('product.id')->toArray();

        $recommendedProducts = Product::whereNotIn('id', $wishlistProductIds)
            ->inRandomOrder()

            ->get();

        return view('wishlist.index', compact('wishlistItems', 'recommendedProducts'));
    }
}
