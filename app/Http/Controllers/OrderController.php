<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order) {
        $order->load('products');
        return response()->json($order);
    }

    public function showCustomerOrder(Order $order)
{
    // Verify the order belongs to the authenticated user
    if ($order->user_id !== Auth::id()) {
        abort(403);
    }

    return view('orders.show', [
        'order' => $order,
        'subtotal' => $order->subtotal,
        'shipping' => $order->shipping,
        'tax' => $order->tax,
        'total' => $order->total
    ]);
}
}
