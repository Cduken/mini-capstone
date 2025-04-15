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
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 text-sm">
                        <i class='bx bx-store mr-2'></i> Start Shopping
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
                                                {{ $order->status === 'completed' || $order->status === 'delivered'
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
                                                        {{ $order->status === 'completed' || $order->status === 'delivered'
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
                                                        {{ $order->status === 'completed' || $order->status === 'delivered'
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
                                                    @php
                                                        $rating = $order
                                                            ->ratings()
                                                            ->where('product_id', $product->id)
                                                            ->where('user_id', Auth::id())
                                                            ->first();
                                                    @endphp
                                                    @if (in_array($order->status, ['delivered', 'completed']) && !$rating)
                                                        <button
                                                            onclick="showRatingModal({{ $order->id }}, {{ $product->id }})"
                                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                                                            <i class='bx bxs-star mr-1'></i> Rate Product
                                                        </button>
                                                    @elseif (in_array($order->status, ['delivered', 'completed']) && $rating)
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-lg text-sm bg-green-100 text-green-800">
                                                            <i class='bx bxs-star mr-1'></i> Rated
                                                            ({{ $rating->rating }}/5)
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Order footer -->
                            <div class="px-6 py-4 sm:px-6 bg-gray-50 flex flex-wrap justify-end gap-3">
                                @if ($order->status !== 'cancelled')
                                    <a href="{{ route('orders.start-tracking', $order) }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 {{ $order->status === 'cancelled' ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                        {{ $order->status === 'cancelled' ? 'disabled' : '' }}>
                                        <i class='bx bx-play mr-2'></i> Track Order
                                    </a>
                                @endif
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

    <!-- Rating Modal -->
    <div id="ratingModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden" style="max-height: 90vh;">
            <!-- Modal Header -->
            <div class="bg-gradient-to-br from-purple-500 to-indigo-600 p-5 text-center relative">
                <button onclick="closeRatingModal()" class="absolute top-3 right-3 text-white hover:text-gray-200">
                    <i class='bx bx-x text-2xl'></i>
                </button>
                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
                    <div class="h-10 w-10 bg-white mt-[25px] rounded-full shadow-lg flex items-center justify-center">
                        <i class='bx bxs-star text-yellow-400 text-2xl'></i>
                    </div>
                </div>
                <h1 class="text-xl font-bold text-white mt-6">Rate Your Product</h1>
                <p class="text-sm text-white/90 mt-1">Your feedback helps us improve</p>
            </div>

            <!-- Modal Content -->
            <div class="p-5 flex flex-col" style="max-height: calc(90vh - 120px);">
                <div class="mb-4 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-3">
                        <i class='bx bxs-heart text-3xl text-purple-500'></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800">How did we do?</h2>
                    <p class="text-sm text-gray-600 mt-1">Rate the product below</p>
                </div>

                <div id="rating-content" class="space-y-4 overflow-y-auto pr-2 flex-grow mb-4">
                    <!-- Product rating form will be dynamically loaded here -->
                </div>

                <button onclick="closeRatingModal()"
                    class="p-2.5 text-sm font-medium text-purple-600 hover:text-purple-700 transition flex items-center justify-center">
                    Skip Rating
                </button>
            </div>
        </div>
    </div>

    <!-- Cancel Order Confirmation Modal -->
    <div id="cancelOrderModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class='bx bx-error text-xl text-red-600'></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Cancel Order #<span id="orderIdDisplay"></span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to cancel this order? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmCancelBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Yes, Cancel Order
                    </button>
                    <button type="button" onclick="closeCancelModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        No, Keep Order
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Existing styles */
        .bx {
            vertical-align: middle;
        }

        html {
            scroll-behavior: smooth;
        }

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

        .custom-toast-success {
            background: white !important;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 4px solid #10B981;
            min-width: 300px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .custom-toast-error {
            background: white !important;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 4px solid #EF4444;
            min-width: 300px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .custom-toast-info {
            background: white !important;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 4px solid #3B82F6;
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

        /* Rating modal styles */
        @keyframes modalSlideIn {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes modalSlideOut {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            100% {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
        }

        #ratingModal.show {
            animation: modalSlideIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        #ratingModal.hide {
            animation: modalSlideOut 0.3s ease-out forwards;
        }

        @keyframes starBounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .star-rating.active i {
            animation: starBounce 0.5s ease;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(16, 185, 129, 0.5);
            border-radius: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background-color: rgba(16, 185, 129, 0.1);
        }
    </style>

    <script>
        let currentOrderId = null;
        let currentProductId = null;

        // Show rating modal for a specific product
        function showRatingModal(orderId, productId) {
            // Find the order and product directly
            const orders = @json($orders->load('ratings')); // Ensure ratings are loaded
            const order = orders.find(o => o.id == orderId);
            if (!order) {
                Toastify({
                    node: createNotificationElement(
                        'bx bx-error-alt',
                        '#EF4444',
                        'Error',
                        'Order not found'
                    ),
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'custom-toast-error'
                }).showToast();
                return;
            }

            const product = order.products.find(p => p.id == productId);
            if (!product) {
                Toastify({
                    node: createNotificationElement(
                        'bx bx-error-alt',
                        '#EF4444',
                        'Error',
                        'Product not found'
                    ),
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'custom-toast-error'
                }).showToast();
                return;
            }

            // Check if the product has already been rated for this order
            const rating = order.ratings.find(r => r.product_id == productId && r.user_id == {{ Auth::id() }});
            if (rating) {
                Toastify({
                    node: createNotificationElement(
                        'bx bx-info-circle',
                        '#3B82F6',
                        'Already Rated',
                        'You have already rated this product.'
                    ),
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    className: 'custom-toast-info'
                }).showToast();
                return;
            }

            currentOrderId = orderId;
            currentProductId = productId;
            const ratingContent = document.getElementById('rating-content');
            const ratingModal = document.getElementById('ratingModal');

            ratingContent.innerHTML = `
                <div class="border border-gray-100 rounded-xl p-4 shadow-sm bg-gradient-to-br from-white to-gray-50">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden mr-3 flex-shrink-0 shadow-inner">
                            <img src="${product.image || '/default.jpg'}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">${product.title}</p>
                            <p class="text-xs text-gray-500">${product.pivot.quantity} × $${(product.pivot.price)}</p>
                        </div>
                    </div>
                    <form action="/products/${productId}/rate" method="POST" class="rating-form">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="order_id" value="${orderId}">
                        <div class="flex flex-col items-center">
                            <div class="flex justify-center space-x-1 mb-3">
                                ${[1,2,3,4,5].map(i => `
                                    <button type="button" class="star-rating transform hover:scale-110 transition-transform" data-rating="${i}">
                                        <i class='bx bx-star text-2xl text-gray-300'></i>
                                    </button>
                                `).join('')}
                                <input type="hidden" name="rating" value="0">
                            </div>
                            <div class="flex justify-between w-full text-xs text-gray-500 mb-3 px-2">
                                <span>Poor</span>
                                <span>Fair</span>
                                <span>Good</span>
                                <span>Very Good</span>
                                <span>Excellent</span>
                            </div>
                            <button type="submit" class="w-full py-2 bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white rounded-lg text-sm font-medium transition flex items-center justify-center shadow-md">
                                <i class='bx bx-check-circle mr-2'></i> Submit Rating
                            </button>
                        </div>
                    </form>
                </div>
            `;

            ratingModal.classList.remove('hidden');
            ratingModal.classList.add('show');
            initializeStarRatings();

            // Attach the event listener to the newly created form
            const form = ratingContent.querySelector('.rating-form');
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                const formData = new FormData(this);

                try {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bx bx-loader-alt animate-spin mr-2"></i> Submitting...';

                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();

                    if (response.ok) {
                        Toastify({
                            node: createNotificationElement(
                                'bx bx-check-circle',
                                '#10B981',
                                'Rating Submitted',
                                data.message
                            ),
                            duration: 4000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            className: 'custom-toast-success'
                        }).showToast();
                        closeRatingModal();
                        // Update the UI without reloading
                        const rateButton = document.querySelector(
                            `button[onclick="showRatingModal(${orderId}, ${productId})"]`);
                        if (rateButton) {
                            rateButton.outerHTML = `
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm bg-green-100 text-green-800">
                                    <i class='bx bxs-star mr-1'></i> Rated (${data.rating}/5)
                                </span>
                            `;
                        }
                    } else {
                        Toastify({
                            node: createNotificationElement(
                                'bx bx-error-alt',
                                '#EF4444',
                                'Failed to submit rating',
                                data.message || 'Please try again later'
                            ),
                            duration: 4000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            className: 'custom-toast-error'
                        }).showToast();
                    }
                } catch (error) {
                    console.error('Error:', error);
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
                        className: 'custom-toast-error'
                    }).showToast();
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        }

        function closeRatingModal() {
            const ratingModal = document.getElementById('ratingModal');
            ratingModal.classList.remove('show');
            ratingModal.classList.add('hide');
            setTimeout(() => {
                ratingModal.classList.add('hidden');
                ratingModal.classList.remove('hide');
                currentOrderId = null;
                currentProductId = null;
            }, 300);
        }

        function initializeStarRatings() {
            document.querySelectorAll('.star-rating').forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const form = this.closest('.rating-form');
                    this.classList.add('active');
                    setTimeout(() => this.classList.remove('active'), 500);
                    this.parentElement.querySelectorAll('.star-rating i').forEach((icon, index) => {
                        if (index < rating) {
                            icon.classList.remove('bx-star', 'text-gray-300');
                            icon.classList.add('bxs-star', 'text-yellow-400');
                        } else {
                            icon.classList.remove('bxs-star', 'text-yellow-400');
                            icon.classList.add('bx-star', 'text-gray-300');
                        }
                    });
                    form.querySelector('input[name="rating"]').value = rating;
                });
            });
        }

        // Cancel Order Functions
        function confirmCancelOrder(orderId) {
            currentOrderId = orderId;
            document.getElementById('orderIdDisplay').textContent = orderId;
            document.getElementById('cancelOrderModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            const trackingButton = document.querySelector(`a[href="/orders/${orderId}/start-tracking"]`);
            if (trackingButton) {
                trackingButton.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                trackingButton.setAttribute('disabled', 'disabled');
            }
        }

        function closeCancelModal() {
            document.getElementById('cancelOrderModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            if (currentOrderId) {
                const trackingButton = document.querySelector(`a[href="/orders/${currentOrderId}/start-tracking"]`);
                if (trackingButton && !trackingButton.classList.contains('permanently-disabled')) {
                    trackingButton.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                    trackingButton.removeAttribute('disabled');
                }
            }
        }

        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            if (currentOrderId) {
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
                                className: 'custom-toast-success'
                            }).showToast();
                            const trackingButton = document.querySelector(
                                `a[href="/orders/${currentOrderId}/start-tracking"]`);
                            if (trackingButton) {
                                trackingButton.classList.add('permanently-disabled');
                            }
                            closeCancelModal();
                            setTimeout(() => window.location.reload(), 1500);
                        } else {
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
                                className: 'custom-toast-error'
                            }).showToast();
                            const trackingButton = document.querySelector(
                                `a[href="/orders/${currentOrderId}/start-tracking"]`);
                            if (trackingButton) {
                                trackingButton.classList.remove('opacity-50', 'cursor-not-allowed',
                                    'pointer-events-none');
                                trackingButton.removeAttribute('disabled');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
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
                            className: 'custom-toast-error'
                        }).showToast();
                        const trackingButton = document.querySelector(
                            `a[href="/orders/${currentOrderId}/start-tracking"]`);
                        if (trackingButton) {
                            trackingButton.classList.remove('opacity-50', 'cursor-not-allowed',
                                'pointer-events-none');
                            trackingButton.removeAttribute('disabled');
                        }
                    })
                    .finally(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
            }
        });

        function createNotificationElement(iconClass, iconBgColor, title, message) {
            const div = document.createElement('div');
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
    </script>

    <!-- Toastify for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</x-app-layout>
