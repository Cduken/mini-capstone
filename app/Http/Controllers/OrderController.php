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

    public function show(Order $order)
    {
        try {
            return response()->json([
                'id' => $order->id,
                'name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
                'status' => $order->status,
                'total' => $order->total,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'shipping' => $order->shipping,
                'created_at' => $order->created_at,
                'address' => $order->address,
                'city' => $order->city,
                'state' => $order->state,
                'zip_code' => $order->zip_code,
                'country' => $order->country,
                'payment_method' => $order->payment_method,
                'payment_details' => json_decode($order->payment_details, true) ?? [],
                'items' => json_decode($order->items, true) ?? [],
                'shipping_method' => $order->shipping_method
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch order details',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function showCustomerOrder(Order $order)
    {
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
