<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with order number and status -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $order->status === 'completed'
                        ? 'bg-green-100 text-green-800'
                        : ($order->status === 'shipped'
                            ? 'bg-blue-100 text-blue-800'
                            : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Main card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Order items section -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Your Items</h2>
                    <div class="space-y-4">
                        @foreach (json_decode($order->items, true) as $item)
                            <div class="flex items-start gap-4 pb-4 border-b border-gray-100 last:border-0">
                                <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ asset($item['image'] ?? 'images/placeholder-product.png') }}"
                                        alt="{{ $item['product_name'] }}" class="w-full h-full object-cover"
                                        onerror="this.src='{{ asset('images/placeholder-product.png') }}'">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $item['product_name'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Quantity: {{ $item['quantity'] }}</p>
                                    <p class="text-sm text-gray-500">${{ number_format($item['price'], 2) }} each</p>
                                </div>
                                <div class="font-medium text-gray-900">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order summary -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-gray-200 font-bold text-gray-900">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping and payment info -->
                <div class="grid md:grid-cols-2 gap-6 p-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800">Shipping Information</h2>
                        </div>
                        <div class="space-y-1 text-gray-600">
                            <p>{{ $order->name }}</p>
                            <p>{{ $order->address }}</p>
                            <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                            <p>{{ $order->country }}</p>
                            <p class="pt-2 text-sm">
                                <span class="font-medium">Method:</span>
                                {{ $order->shipping_method }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd"
                                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-800">Payment Information</h2>
                        </div>
                        <div class="space-y-1 text-gray-600">
                            <p>
                                <span class="font-medium">Method:</span>
                                {{ ucfirst($order->payment_method) }}
                            </p>
                            @if ($order->payment_method === 'gcash')
                                <p>
                                    <span class="font-medium">GCash Number:</span>
                                    {{ json_decode($order->payment_details)->number }}
                                </p>
                            @endif
                            <p class="text-sm text-green-600 font-medium mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Payment successful
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('home') }}"
                    class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-center font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Back to Home
                </a>
                <a href="{{ route('products.index') }}"
                    class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-center font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
