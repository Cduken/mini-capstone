<x-app-layout>
    <div class="py-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Your Order History</h1>
                    <p class="mt-1 text-sm text-gray-600">Track and manage all your past purchases</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class='bx bx-arrow-back mr-2'></i> Continue Shopping
                </a>
            </div>

            @if ($orders->isEmpty())
                <!-- Empty state -->
                <div
                    class="text-center bg-white rounded-xl shadow-sm p-12 border border-gray-100 transform hover:scale-[1.01] transition-transform duration-200">
                    <div
                        class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gradient-to-br from-blue-50 to-purple-50 mb-4">
                        <i class='bx bx-package text-4xl text-blue-500'></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No orders yet</h3>
                    <p class="text-gray-500 mb-6">Your purchased items will appear here</p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        Start Shopping
                    </a>
                </div>
            @else
                <!-- Orders list -->
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-white overflow-hidden shadow rounded-xl divide-y divide-gray-200 border border-gray-100 hover:shadow-md transition-shadow duration-300">
                            <!-- Order header -->
                            <div class="px-6 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="mb-3 sm:mb-0">
                                        <div class="flex items-center">
                                            <h3 class="text-lg font-bold text-gray-900">
                                                Order #{{ $order->id }}
                                            </h3>
                                            <span
                                                class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                {{ $order->status === 'completed'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($order->status === 'processing'
                                                        ? 'bg-blue-100 text-blue-800'
                                                        : ($order->status === 'cancelled'
                                                            ? 'bg-red-100 text-red-800'
                                                            : ($order->status === 'shipped'
                                                                ? 'bg-purple-100 text-purple-800'
                                                                : 'bg-yellow-100 text-yellow-800'))) }}">
                                                <span class="relative flex h-2 w-2 mr-1">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                    {{ $order->status === 'completed'
                                                        ? 'bg-green-400'
                                                        : ($order->status === 'processing'
                                                            ? 'bg-blue-400'
                                                            : ($order->status === 'cancelled'
                                                                ? 'bg-red-400'
                                                                : ($order->status === 'shipped'
                                                                    ? 'bg-purple-400'
                                                                    : 'bg-yellow-400'))) }}"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-2 w-2
                                                    {{ $order->status === 'completed'
                                                        ? 'bg-green-500'
                                                        : ($order->status === 'processing'
                                                            ? 'bg-blue-500'
                                                            : ($order->status === 'cancelled'
                                                                ? 'bg-red-500'
                                                                : ($order->status === 'shipped'
                                                                    ? 'bg-purple-500'
                                                                    : 'bg-yellow-500'))) }}"></span>
                                                </span>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <div class="mt-2 flex flex-wrap gap-2">
                                            <p class="flex items-center text-sm text-gray-600">
                                                <i class='bx bx-calendar mr-1.5'></i>
                                                {{ $order->created_at->format('F j, Y \\a\\t g:i A') }}
                                            </p>
                                            <p class="flex items-center text-sm text-gray-600">
                                                <i class='bx bx-credit-card mr-1.5'></i>
                                                {{ ucfirst($order->payment_method) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-bold text-gray-900">
                                            ${{ number_format($order->total, 2) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $order->products->sum('pivot.quantity') }} items</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order items -->
                            <div class="px-6 py-5 sm:p-6">
                                <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class='bx bx-package mr-2'></i> Purchased Items
                                </h4>
                                <div class="space-y-4">
                                    @foreach ($order->products as $product)
                                        <div
                                            class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                                            <div
                                                class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border border-gray-200">
                                                <img src="{{ asset($product->image ?? 'default.jpg') }}"
                                                    alt="{{ $product->title }}"
                                                    class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <h5
                                                            class="text-base font-semibold text-gray-900 hover:text-blue-600 transition-colors duration-200">
                                                            {{ $product->title }}
                                                        </h5>
                                                        <div class="mt-1 flex flex-wrap gap-2">
                                                            <p class="text-sm text-gray-500 flex items-center">
                                                                <i class='bx bx-cube mr-1'></i> Qty:
                                                                {{ $product->pivot->quantity }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 flex items-center">
                                                                {{-- <i class='bx bx-dollar mr-1'></i> --}}
                                                                ${{ number_format($product->pivot->price, 2) }} each
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <p class="ml-4 text-base font-semibold text-gray-900">
                                                        ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                                    </p>
                                                </div>
                                                <div class="mt-3 flex space-x-2">
                                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity"
                                                            value="{{ $product->pivot->quantity ?? 1 }}">
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 border border-gray-200 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                            <i class='bx bx-refresh mr-1'></i> Buy Again
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('products.show', $product) }}"
                                                        class="inline-flex items-center px-3 py-1 border border-gray-200 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                        <i class='bx bx-info-circle mr-1'></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Order footer -->
                            <div class="px-6 py-4 sm:px-6 bg-gray-50 flex flex-wrap justify-end gap-3">
                                <a href="{{ route('orders.start-tracking', $order) }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <i class='bx bx-play mr-2'></i> Start Tracking
                                </a>

                                @if ($order->canBeCancelled())
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:-translate-y-0.5"
                                        onclick="confirmCancelOrder('{{ $order->id }}')">
                                        <i class='bx bx-x mr-2'></i> Cancel Order
                                    </button>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm bg-gray-100 text-gray-600">
                                        <i class='bx bx-lock mr-1.5'></i> Order {{ ucfirst($order->status) }}
                                        @if ($order->payment_method !== 'cod')
                                            (Non-cancellable)
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Cancel Order Confirmation Modal -->
    <div id="cancelOrderModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class='bx bx-error text-red-600 text-xl'></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Cancel Order #<span id="orderIdDisplay"></span>?
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to cancel this order? This action cannot be undone. Any
                                    payment made will be refunded to your original payment method.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-xl">
                    <button type="button" id="confirmCancelBtn"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-base font-medium text-white hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200 transform hover:-translate-y-0.5">
                        Yes, Cancel Order
                    </button>
                    <button type="button" onclick="closeCancelModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200">
                        Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bx {
            vertical-align: middle;
        }

        /* Smooth scrolling for the page */
        html {
            scroll-behavior: smooth;
        }

        /* Fade-in animation for orders */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .space-y-6>div {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Delay animations for each order */
        .space-y-6>div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .space-y-6>div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .space-y-6>div:nth-child(3) {
            animation-delay: 0.3s;
        }

        .space-y-6>div:nth-child(4) {
            animation-delay: 0.4s;
        }

        .space-y-6>div:nth-child(5) {
            animation-delay: 0.5s;
        }

        .custom-toast {
            background: white !important;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 4px solid currentColor;
            min-width: 300px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .Toastify__close-button {
            color: #6B7280;
            opacity: 0.7;
            align-self: flex-start;
        }

        .Toastify__close-button:hover {
            opacity: 1;
        }
    </style>

    <script>
        let currentOrderId = null;

        function confirmCancelOrder(orderId) {
            currentOrderId = orderId;
            document.getElementById('orderIdDisplay').textContent = orderId;
            document.getElementById('cancelOrderModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeCancelModal() {
            document.getElementById('cancelOrderModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            if (currentOrderId) {
                // Show loading state
                const btn = this;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="bx bx-loader bx-spin mr-2"></i> Processing...';
                btn.disabled = true;

                fetch(`/orders/${currentOrderId}/cancel`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        data
                    })))
                    .then(({
                        status,
                        data
                    }) => {
                        if (status === 200 && data.success) {
                            // Success notification with icon
                            Toastify({
                                node: createNotificationElement(
                                    'bx bx-check-circle',
                                    '#10B981',
                                    'Order cancelled successfully!',
                                    'Refund processing...'
                                ),
                                duration: 4000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: 'transparent',
                                    boxShadow: '0 4px 15px rgba(16, 185, 129, 0.2)'
                                }
                            }).showToast();

                            // Close modal and reload
                            closeCancelModal();
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
                            // Error notification with icon
                            Toastify({
                                node: createNotificationElement(
                                    'bx bx-error-alt',
                                    '#EF4444',
                                    'Failed to cancel order',
                                    data.message || 'Please try again later'
                                ),
                                duration: 4000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: 'transparent',
                                    boxShadow: '0 4px 15px rgba(239, 68, 68, 0.2)'
                                }
                            }).showToast();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Network error notification
                        Toastify({
                            node: createNotificationElement(
                                'bx bx-wifi-off',
                                '#6B7280',
                                'Network Error',
                                'Failed to connect to server'
                            ),
                            duration: 4000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: 'transparent',
                                boxShadow: '0 4px 15px rgba(107, 114, 128, 0.2)'
                            }
                        }).showToast();
                    })
                    .finally(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
            }

            // Helper function to create notification element with icon
            function createNotificationElement(iconClass, iconBgColor, title, message) {
                const div = document.createElement('div');
                div.className = 'custom-toast';
                div.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0 p-2 rounded-full" style="background-color: ${iconBgColor}20">
                <i class="${iconClass} text-lg" style="color: ${iconBgColor}"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">${title}</p>
                <p class="text-sm text-gray-500 mt-1">${message}</p>
            </div>
        </div>
    `;
                return div;
            }
        });
    </script>

    <!-- Toastify for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</x-app-layout>
