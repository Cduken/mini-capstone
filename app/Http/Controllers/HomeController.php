<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredIds = [1, 3, 5, 7, 9, 11, 13, 15];

        $products = Product::withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->whereIn('id', $featuredIds)
            ->get();

        return view('home', compact('products'));
    }
}
