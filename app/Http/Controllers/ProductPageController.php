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

        $query = Product::query()
            ->withCount('ratings')
            ->withAvg('ratings', 'rating'); // Always include this to avoid N+1 issues

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        // Price range filter
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Sorting logic
        switch ($sort) {
            case 'rating':
                $query->orderBy('ratings_avg_rating', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(6);

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
