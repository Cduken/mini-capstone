@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-white mb-6">Your Orders</h1>

    <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
        @forelse($orders as $order)
        <div class="border-b border-gray-700 last:border-b-0">
            <a href="{{ route('orders.show', $order) }}" class="block hover:bg-gray-700 transition-colors">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-white">Order #{{ $order->id }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                Placed on {{ $order->created_at->format('F j, Y') }}
                            </p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($order->status === 'completed') bg-green-900 text-green-300
                            @elseif($order->status === 'processing') bg-blue-900 text-blue-300
                            @else bg-gray-700 text-gray-300 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="px-6 py-8 text-center">
            <p class="text-gray-400">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-blue-400 hover:text-blue-300">
                Browse Products
            </a>
        </div>
        @endforelse
    </div>

    @if($orders->count() > 0)
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
