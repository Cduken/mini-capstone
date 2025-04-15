<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $minPrice = $request->input('min_price', 500);
        $maxPrice = $request->input('max_price', 10000);
        $sort = $request->input('sort', 'latest');
        $ratings = array_map('intval', (array) $request->input('ratings', []));
        $order_id = session('order_id');

        $query = Product::query()
            ->withCount('ratings')
            ->withAvg('ratings', 'rating');

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        // Price filter
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Rating filter
        if (!empty($ratings)) {
            $minRating = min($ratings); // Use the lowest selected rating
            $query->whereHas('ratings', function ($q) use ($minRating) {
                $q->where('rating', '>=', $minRating);
            });
        }

        // Sorting
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
            'ratings' => $ratings,
            'order_id' => $order_id
        ]);
    }

    // The rate method remains unchanged
    public function rate(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'order_id' => [
                'required',
                'exists:orders,id',
                function ($attribute, $value, $fail) {
                    if (!Order::where('id', $value)->where('user_id', Auth::id())->exists()) {
                        $fail('The selected order is invalid or you do not have access to it.');
                    }
                },
            ],
        ]);

        $order = Order::findOrFail($request->order_id);

        // Verify the product is part of the order
        $productInOrder = $order->products()->where('product_id', $product->id)->exists();
        if (!$productInOrder) {
            return response()->json([
                'success' => false,
                'message' => 'This product is not part of the specified order.'
            ], 403);
        }

        // Check for existing rating
        $existingRating = Rating::where([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $request->order_id,
        ])->first();

        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this product for this order.'
            ], 403);
        }

        try {
            DB::beginTransaction();
            $rating = Rating::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'order_id' => $request->order_id,
                'rating' => $request->rating,
            ]);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your rating!',
                'rating' => $rating->rating,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Rating creation failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'order_id' => $request->order_id,
                'rating' => $request->rating,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to save rating. Please try again.'
            ], 500);
        }
    }
}
