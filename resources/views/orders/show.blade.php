<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Order #{{ $order->id }}</h1>

                    <!-- Order status and summary -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <span class="font-medium">Status:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <!-- Order items display -->
                        <div class="space-y-4 mb-6">
                            @foreach(json_decode($order->items, true) as $item)
                            <div class="flex items-center border-b pb-4">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden mr-4">
                                    <img src="{{ asset($item['image'] ?? 'default.jpg') }}"
                                         alt="{{ $item['product_name'] }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium">{{ $item['product_name'] }}</h3>
                                    <p class="text-gray-600 text-sm">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="font-medium">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Order totals -->
                        <div class="border-t pt-4 space-y-2">
                            <div class="flex justify-between">
                                <span>Subtotal:</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping:</span>
                                <span>${{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Tax:</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg pt-2">
                                <span>Total:</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping and payment info -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-lg font-medium mb-4">Shipping Information</h2>
                            <p>{{ $order->address }}</p>
                            <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                            <p>{{ $order->country }}</p>
                            <p class="mt-2"><span class="font-medium">Method:</span> {{ $order->shipping_method }}</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-medium mb-4">Payment Information</h2>
                            <p><span class="font-medium">Method:</span> {{ ucfirst($order->payment_method) }}</p>
                            @if($order->payment_method === 'gcash')
                                <p><span class="font-medium">GCash Number:</span> {{ json_decode($order->payment_details)->number }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
