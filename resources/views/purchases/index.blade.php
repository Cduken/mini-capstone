<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order History</h1>
                    <p class="mt-1 text-sm text-gray-500">View all your past purchases</p>
                </div>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class='bx bx-arrow-back mr-2'></i> Continue Shopping
                </a>
            </div>

            @if ($orders->isEmpty())
                <!-- Empty state -->
                <div class="text-center bg-white rounded-lg shadow-sm p-12">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gray-100 mb-4">
                        <i class='bx bx-package text-4xl text-gray-400'></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No orders yet</h3>
                    <p class="text-gray-500 mb-6">Your purchased items will appear here</p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Start Shopping
                    </a>
                </div>
            @else
                <!-- Orders list -->
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                            <!-- Order header -->
                            <div class="px-6 py-5 sm:px-6 bg-gray-50">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="mb-3 sm:mb-0">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Order #{{ $order->id }}
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' :
                                                   ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' :
                                                   'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Placed on {{ $order->created_at->format('F j, Y \\a\\t g:i A') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-semibold text-gray-900">${{ number_format($order->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order items -->
                            <div class="px-6 py-5 sm:p-6">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Items</h4>
                                <div class="space-y-6">
                                    @foreach ($order->products as $product)
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-20 h-20 rounded-md overflow-hidden">
                                                <img src="{{ asset($product->image ?? 'default.jpg') }}"
                                                     alt="{{ $product->title }}"
                                                     class="w-full h-full object-cover object-center">
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <h5 class="text-base font-medium text-gray-900">{{ $product->title }}</h5>
                                                        <p class="mt-1 text-sm text-gray-500">Qty: {{ $product->pivot->quantity }}</p>
                                                    </div>
                                                    <p class="ml-4 text-base font-medium text-gray-900">
                                                        ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                                    </p>
                                                </div>
                                                <div class="mt-3 flex space-x-2">

                                                    <button type="button"
                                                            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        <i class='bx bx-refresh mr-1'></i> Reorder
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Order footer -->
                            <div class="px-6 py-4 sm:px-6 bg-gray-50 flex justify-end space-x-3">
                                <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="confirmCancelOrder('{{ $order->id }}')">
                                    <i class='bx bx-x mr-2'></i> Cancel Order
                                </button>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Cancel Order Confirmation Modal -->
    <div id="cancelOrderModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i class='bx bx-error text-red-600 text-xl'></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Cancel Order?
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to cancel this order? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="button" id="confirmCancelBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                        Yes, Cancel Order
                    </button>
                    <button type="button" onclick="closeCancelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">
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
    </style>

    <script>
        let currentOrderId = null;

        function confirmCancelOrder(orderId) {
            currentOrderId = orderId;
            document.getElementById('cancelOrderModal').classList.remove('hidden');
        }

        function closeCancelModal() {
            document.getElementById('cancelOrderModal').classList.add('hidden');
        }

        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            if (currentOrderId) {
                // Here you would typically make an AJAX call to cancel the order
                fetch(`/orders/${currentOrderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Failed to cancel order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while cancelling the order');
                })
                .finally(() => {
                    closeCancelModal();
                });
            }
        });
    </script>
</x-app-layout>
