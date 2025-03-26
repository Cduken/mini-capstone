<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ViewOrderDetails extends Controller
{
    public function view(Order $order) {
        $order->load('products');
        return view('admin.view.details', compact('order'));
    }
}
