<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $minPrice = $request->input('min_price', 500);
        $maxPrice = $request->input('max_price', 10000);

        $products = Product::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%');
        })
            ->when($request->filled('min_price') || $request->filled('max_price'), function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            })
            ->latest()
            ->paginate(6);

        return view('products.index', [
            'products' => $products,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'searchQuery' => $search
        ]);
    }

    public function getProductJson(Product $product)
    {
        return response()->json($product);
    }
}
