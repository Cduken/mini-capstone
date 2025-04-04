<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RatingController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'order_id' => [
                'required',
                'exists:orders,id',
                function ($attribute, $value, $fail) {
                    // Verify the order belongs to the authenticated user
                    if (!Order::where('id', $value)->where('user_id', Auth::id())->exists()) {
                        $fail('The selected order is invalid.');
                    }
                },
            ],
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'order_id' => $request->order_id
            ],
            [
                'rating' => $request->rating
            ]
        );

        return back()->with('success', 'Thank you for your rating!');
    }
}
