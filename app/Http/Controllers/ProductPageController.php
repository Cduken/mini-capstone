<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $minPrice = $request->input('min_price', 500);
        $maxPrice = $request->input('max_price', 10000);
        $sort = $request->input('sort', 'latest');
        $order_id = session('order_id');

        $products = Product::query()
            ->withCount('ratings')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            })
            ->when($request->filled('min_price') || $request->filled('max_price'), function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            })
            ->when($sort === 'rating', function ($query) {
                $query->withAvg('ratings', 'rating')
                    ->orderBy('ratings_avg_rating', 'desc');
            })
            ->when($sort === 'price_asc', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($sort === 'price_desc', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($sort === 'latest', function ($query) {
                $query->latest();
            })
            ->paginate(6);

        return view('products.index', [
            'products' => $products,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'searchQuery' => $search,
            'currentSort' => $sort,
            'order_id' => $order_id
        ]);
    }

    public function rate(Product $product, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::find($request->order_id);

        if (!$order || $order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid order ID or unauthorized access.'
            ], 403);
        }

        // Save the rating
        $product->ratings()->updateOrCreate(
            [
                'user_id' => Auth::id(),
                'order_id' => $order->id
            ],
            [
                'rating' => $request->rating
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your rating!'
        ]);
    }
}
