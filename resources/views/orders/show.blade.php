@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-700">
            <h1 class="text-xl font-bold text-white">Order #{{ $order->id }}</h1>
            <p class="text-sm text-gray-400 mt-1">
                Placed on {{ $order->created_at->format('F j, Y \a\t g:i a') }}
            </p>
        </div>

        <div class="p-6">
            <!-- Order status -->
            <div class="mb-6">
                <h2 class="text-lg font-medium text-white mb-2">Order Status</h2>
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    @if($order->status === 'completed') bg-green-900 text-green-300
                    @elseif($order->status === 'processing') bg-blue-900 text-blue-300
                    @else bg-gray-700 text-gray-300 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Order items -->
            <div class="mb-6">
                <h2 class="text-lg font-medium text-white mb-4">Order Items</h2>
                @foreach(json_decode($order->items, true) as $item)
                <div class="flex items-center py-3 border-b border-gray-700">
                    <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden bg-gray-700">
                        <img src="{{ $item['image'] ?? asset('images/default-product.png') }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-white">{{ $item['name'] }}</h3>
                        <p class="text-sm text-gray-400">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <div class="ml-4 text-right">
                        <p class="text-sm font-medium text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order summary -->
            <div class="bg-gray-900 rounded-lg p-4">
                <h2 class="text-lg font-medium text-white mb-4">Order Summary</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="text-white">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Shipping</span>
                        <span class="text-white">${{ number_format($order->shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tax</span>
                        <span class="text-white">${{ number_format($order->tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-gray-700">
                        <span class="text-lg font-medium text-white">Total</span>
                        <span class="text-lg font-medium text-white">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
