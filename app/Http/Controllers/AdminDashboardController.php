<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $recentOrders = Order::orderBy('created_at', 'desc')->get();
        $averageOrderValue = Order::avg('total');
        $conversionRate = $totalUsers > 0 ? ($totalOrders / $totalUsers) * 100 : 0;
        $newUsersCount = User::where('created_at', '>=', Carbon::now()->subDays(5))->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'recentOrders',
            'averageOrderValue',
            'conversionRate',
            'newUsersCount',
            'pendingOrdersCount'
        ));
    }
}
