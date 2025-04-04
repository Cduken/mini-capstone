<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Dashboard statistics
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $recentOrders = Order::latest()->paginate(5);
        $recentUsers = User::latest()->paginate(5);

        // For AJAX requests (users table pagination)
        if ($request->ajax()) {
            if ($request->has('users_page')) {
                return view('admin.partials.users_table', ['users' => $recentUsers]);
            }
            return view('admin.partials.orders_table', ['recentOrders' => $recentOrders]);
        }

        // Calculate statistics
        $averageOrderValue = Order::avg('total') ?? 0;
        $conversionRate = $totalUsers > 0 ? ($totalOrders / $totalUsers) * 100 : 0;
        $newUsersCount = User::where('created_at', '>=', Carbon::now()->subMinutes(40))->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();

        $productsPercentageChange = $this->calculateMonthlyPercentageChange(Product::class, 'created_at');
        $ordersPercentageChange = $this->calculateMonthlyPercentageChange(Order::class, 'created_at');
        $usersPercentageChange = $this->calculateMonthlyPercentageChange(User::class, 'created_at');

        $avgOrderPercentageChange = $this->calculateAvgOrderPercentageChange();
        $conversionPercentageChange = $this->calculateConversionPercentageChange();
        $newUsersPercentageChange = $this->calculateNewUsersPercentageChange();
        $pendingPercentageChange = $this->calculatePendingPercentageChange();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'recentOrders',
            'recentUsers',
            'averageOrderValue',
            'conversionRate',
            'newUsersCount',
            'pendingOrdersCount',
            'productsPercentageChange',
            'ordersPercentageChange',
            'usersPercentageChange',
            'avgOrderPercentageChange',
            'conversionPercentageChange',
            'newUsersPercentageChange',
            'pendingPercentageChange'
        ));
    }

    private function calculateMonthlyPercentageChange($model, $dateColumn)
    {
        $currentMonthCount = $model::whereMonth($dateColumn, Carbon::now()->month)->count();
        $lastMonthCount = $model::whereMonth($dateColumn, Carbon::now()->subMonth()->month)->count();

        return $this->calculatePercentageChange($currentMonthCount, $lastMonthCount);
    }

    private function calculateAvgOrderPercentageChange()
    {
        $current = Order::whereMonth('created_at', Carbon::now()->month)->avg('total') ?? 0;
        $previous = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->avg('total') ?? 0;
        return $this->calculatePercentageChange($current, $previous);
    }

    private function calculateConversionPercentageChange()
    {
        $current = $this->calculateMonthlyConversionRate(Carbon::now()->month);
        $previous = $this->calculateMonthlyConversionRate(Carbon::now()->subMonth()->month);
        return $this->calculatePercentageChange($current, $previous);
    }

    private function calculateNewUsersPercentageChange()
    {
        $current = User::whereMonth('created_at', Carbon::now()->subMinutes(60))->count();
        $previous = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        return $this->calculatePercentageChange($current, $previous);
    }

    private function calculatePendingPercentageChange()
    {
        $current = Order::where('status', 'pending')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $previous = Order::where('status', 'pending')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
        return $this->calculatePercentageChange($current, $previous);
    }

    private function calculateMonthlyConversionRate($month)
    {
        $users = User::whereMonth('created_at', $month)->count();
        $orders = Order::whereMonth('created_at', $month)->count();
        return $users > 0 ? ($orders / $users) * 100 : 0;
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous > 0) {
            return (($current - $previous) / $previous) * 100;
        }
        return $current > 0 ? 100 : 0;
    }

    public function showCustomerOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('admin.order-details', [
            'order' => $order,
            'products' => $order->products,
            'items' => $order->items,
            'subtotal' => $order->subtotal,
            'shipping' => $order->shipping,
            'tax' => $order->tax,
            'total' => $order->total
        ]);
    }
}
