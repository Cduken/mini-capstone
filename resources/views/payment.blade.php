<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Progress Steps -->
            <div class="max-w-md mx-auto mb-12">
                <div class="flex items-center">
                    <!-- Step 1 -->
                    <div class="flex items-center relative">
                        <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-600 text-white">
                            <i class='bx bx-check text-xl'></i>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-12 w-32 text-sm font-medium text-blue-600">
                            Shipping Address</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-blue-600"></div>

                    <!-- Step 2 -->
                    <div class="flex items-center relative">
                        <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-600 text-white">
                            <i class='bx bx-check text-xl'></i>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-12 w-32 text-sm font-medium text-blue-600">
                            Shipping Method</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-blue-600"></div>

                    <!-- Step 3 -->
                    <div class="flex items-center relative">
                        <div
                            class="rounded-full h-10 w-10 flex items-center justify-center bg-white border-2 border-blue-600 text-blue-600">
                            <span class="text-lg font-bold">3</span>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-12 w-32 text-sm font-medium text-blue-600">
                            Payment</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Payment Section -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>

                        <!-- Payment Tabs -->
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="-mb-px flex space-x-8">
                                <button type="button" onclick="showPaymentMethod('card')"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab border-blue-500 text-blue-600"
                                    data-method="card">
                                    <i class='bx bx-credit-card mr-2'></i> Credit/Debit Card
                                </button>
                                <button type="button" onclick="showPaymentMethod('gcash')"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-method="gcash">
                                    <i class='bx bx-wallet mr-2'></i> GCash
                                </button>
                                <button type="button" onclick="showPaymentMethod('cod')"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                    data-method="cod">
                                    <i class='bx bx-money mr-2'></i> Cash On Delivery
                                </button>
                            </nav>
                        </div>

                        <!-- Credit Card Payment Form -->
                        <form method="POST" action="{{ route('payment.process') }}" id="cardForm"
                            class="payment-method">
                            @csrf
                            <input type="hidden" name="payment_method" value="card">

                            <!-- Card Icons -->
                            <div class="flex items-center justify-center gap-4 mb-8">
                                <img src="{{ asset('images/Credit Card.png') }}" alt="Credit Cards">
                            </div>

                            <div class="space-y-4">
                                <!-- Cardholder Name -->
                                <div>
                                    <label for="card_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name</label>
                                    <input type="text" id="card_name" name="card_name" placeholder="Name on card"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <!-- Card Number -->
                                <div>
                                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card
                                        Number</label>
                                    <input type="text" id="card_number" name="card_number"
                                        placeholder="1234 5678 9012 3456" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <!-- Expiry and CVV -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="exp_date"
                                            class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                        <input type="month" id="exp_date" name="exp_date" min="{{ date('Y-m') }}"
                                            required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    </div>
                                    <div>
                                        <label for="cvv"
                                            class="block text-sm font-medium text-gray-700 mb-1">Security Code</label>
                                        <div class="relative">
                                            <input type="text" id="cvv" name="cvv" placeholder="CVV"
                                                required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                            <div class="absolute right-3 top-3">
                                                <i
                                                    class='bx bx-question-mark text-gray-400 hover:text-gray-600 cursor-pointer'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Address -->
                                <div class="pt-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="same_address" name="same_address"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="same_address" class="ml-2 block text-sm text-gray-700">Billing
                                            address is same as shipping address</label>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- GCash Payment Form -->
                        <form method="POST" action="{{ route('payment.process') }}" id="gcashForm"
                            class="payment-method hidden">
                            @csrf
                            <input type="hidden" name="payment_method" value="gcash">

                            <!-- GCash Logo -->
                            <div class="flex items-center justify-center gap-4 mb-8">
                                <img src="{{ asset('images/gcash.png') }}" alt="GCash" class="h-40">
                            </div>

                            <div class="space-y-4">
                                <!-- Mobile Number -->
                                <div>
                                    <label for="gcash_number"
                                        class="block text-sm font-medium text-gray-700 mb-1">GCash Mobile
                                        Number</label>
                                    <input type="tel" id="gcash_number" name="gcash_number"
                                        placeholder="09XX XXX XXXX" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <!-- GCash Name -->
                                <div>
                                    <label for="gcash_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">Account Name (as
                                        registered in GCash)</label>
                                    <input type="text" id="gcash_name" name="gcash_name"
                                        placeholder="Ernest Rante Cabarrubias" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>

                                <!-- Instructions -->
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-blue-800 mb-2">How to pay with GCash:</h4>
                                    <ol class="list-decimal list-inside text-sm text-blue-700 space-y-1">
                                        <li>Enter your GCash-registered mobile number</li>
                                        <li>You will receive a payment request via GCash app</li>
                                        <li>Confirm the payment in your GCash app</li>
                                        <li>Wait for payment confirmation (usually instant)</li>
                                    </ol>
                                </div>
                            </div>
                        </form>

                        <!-- Cash on Delivery Form -->
                        <form method="POST" action="{{ route('payment.process') }}" id="codForm"
                            class="payment-method hidden">
                            @csrf
                            <input type="hidden" name="payment_method" value="cod">

                            <!-- COD Icon -->
                            <div class="flex items-center justify-center gap-4 mb-8">
                                <i class='bx bx-money text-6xl text-green-600'></i>
                            </div>

                            <div class="space-y-4">
                                <!-- COD Instructions -->
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-green-800 mb-2">About Cash on Delivery:</h4>
                                    <ul class="list-disc list-inside text-sm text-green-700 space-y-1">
                                        <li>No payment needed now</li>
                                        <li>Pay when your order arrives</li>
                                        <li>We accept cash only</li>
                                        <li>Please prepare exact amount</li>
                                    </ul>
                                </div>

                                <!-- COD Confirmation -->
                                <div class="pt-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="cod_confirm" name="cod_confirm" required
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                        <label for="cod_confirm" class="ml-2 block text-sm text-gray-700">I understand
                                            that I will pay when the order arrives</label>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="mt-8 flex flex-col-reverse sm:flex-row justify-between gap-4">
                            <a href="{{ route('cart.index') }}"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center justify-center">
                                <i class='bx bx-chevron-left mr-2'></i> Back to Cart
                            </a>
                            <button type="submit" form="cardForm" id="submitButton"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-md flex items-center justify-center">
                                <i class='bx bx-lock-alt mr-2'></i> Pay ${{ number_format($total, 2) }}
                            </button>
                        </div>

                        <p class="mt-4 text-center text-sm text-gray-500">
                            <i class='bx bx-shield-alt text-gray-400 mr-1'></i> Secure payment processing
                        </p>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Products List -->
                        <div class="space-y-4 mb-6">
                            @foreach ($cartItems as $item)
                                <div class="flex items-center">
                                    <div
                                        class="relative w-16 h-16 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                        <img src="{{ asset($item->product->image ?? 'default.jpg') }}"
                                            alt="{{ $item->product->title ?? 'Product' }}"
                                            class="w-full h-full object-cover">
                                        <span
                                            class="absolute top-0 right-0 bg-black text-white text-xs px-1 rounded-bl">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="text-sm font-medium text-gray-900">
                                            {{ $item->product->title ?? 'N/A' }}</h3>
                                        <p class="text-sm text-gray-500">SKU: #{{ $item->product_id }}</p>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        ${{ number_format(($item->price ?? 0) * ($item->quantity ?? 1), 2) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Shipping Info -->
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Shipping to:</h3>
                            <div class="flex items-center gap-2">
                                <p class="text-sm text-gray-600">{{ $address }}</p>
                                <p class="text-sm text-gray-600">{{ $city }}, {{ $state }},
                                    {{ $zip_code }}</p>
                                <p class="text-sm text-gray-600">{{ $country }}</p>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900 mt-2 mb-2">Shipping Method:</h3>

                            <p class="text-sm text-gray-600 mt-1">{{ $shippingMethod }}</p>
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Shipping</span>
                                <span>${{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Tax</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-base font-bold text-gray-900 pt-2">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <!-- Success Modal -->
    <div id="successModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden relative"
            style="max-height: 85vh;">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-5 text-center relative">
                <!-- Close Button -->
                <button onclick="closeSuccessModalAndShowRating()"
                    class="absolute top-3 right-3 text-white hover:text-gray-200 transition-colors">
                    <i class='bx bx-x text-xl'></i>
                </button>

                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                    <div class="h-10 w-10 mt-[30px] bg-white rounded-full shadow-md flex items-center justify-center">
                        <div class="h-8 w-8 bg-emerald-100 rounded-full flex items-center justify-center">
                            <i class='bx bx-check text-lg text-emerald-600'></i>
                        </div>
                    </div>
                </div>
                <h1 class="text-xl font-bold text-white mt-[30px]">Order Confirmed!</h1>
                <div class="mt-1">
                    <span class="inline-block px-2 py-0.5 bg-white/20 rounded-full text-xs font-medium text-white">
                        Order #{{ rand(1000, 9999) }}
                    </span>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-5 flex flex-col" style="max-height: calc(85vh - 120px);">
                <!-- Thank You Message -->
                <div class="text-center mb-4">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-full mb-2 mx-auto">
                        <i class='bx bx-party text-xl text-emerald-500'></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800">Thank you for your order!</h2>
                </div>

                <!-- Order Summary -->
                <div class="mb-4 border border-gray-100 rounded-lg p-4 bg-gray-50/50">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-sm font-semibold text-gray-700">Order Summary</h3>
                        <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-medium">
                            {{ count($cartItems) }} items
                        </span>
                    </div>

                    <div class="space-y-2 max-h-[100px] overflow-y-auto mb-3 pr-2 custom-scroll">
                        @foreach ($cartItems as $item)
                            <div class="flex items-center text-xs bg-white p-2 rounded-md">
                                <div class="w-8 h-8 rounded-md bg-gray-100 overflow-hidden mr-2 flex-shrink-0">
                                    <img src="{{ asset($item->product->image ?? 'default.jpg') }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800 truncate text-xs">{{ $item->product->title }}
                                    </p>
                                    <p class="text-2xs text-gray-500">{{ $item->quantity }} ×
                                        ${{ number_format($item->price, 2) }}</p>
                                </div>
                                <p class="text-xs font-semibold text-gray-800 ml-1">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-3 space-y-1 text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-sm pt-2 border-t border-gray-200 mt-2">
                            <span class="text-gray-800">Total</span>
                            <span class="text-emerald-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('products.index') }}"
                        class="p-2 bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white rounded-lg text-xs font-medium transition-all flex items-center justify-center shadow">
                        <i class='bx bx-shopping-bag mr-1 text-sm'></i> Continue Shopping
                    </a>
                    <button onclick="window.print()"
                        class="p-2 bg-white border border-gray-200 hover:border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-xs transition-all flex items-center justify-center shadow-sm">
                        <i class='bx bx-printer mr-1 text-sm'></i> Print Receipt
                    </button>
                </div>
            </div>
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
                <h1 class="text-xl font-bold text-white mt-6">Share Your Experience</h1>
                <p class="text-sm text-white/90 mt-1">Your feedback helps us improve</p>
            </div>

            <!-- Modal Content -->
            <div class="p-5 flex flex-col" style="max-height: calc(90vh - 120px);">
                <div class="mb-4 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-3">
                        <i class='bx bxs-heart text-3xl text-purple-500'></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800">How did we do?</h2>
                    <p class="text-sm text-gray-600 mt-1">Rate your purchased products below</p>
                </div>

                <div id="ratings-container" class="space-y-4 overflow-y-auto pr-2 flex-grow mb-4">
                    @foreach ($cartItems as $item)
                        <div
                            class="border border-gray-100 rounded-xl p-4 shadow-sm bg-gradient-to-br from-white to-gray-50">
                            <div class="flex items-center mb-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden mr-3 flex-shrink-0 shadow-inner">
                                    <img src="{{ asset($item->product->image ?? 'default.jpg') }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->title }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} ×
                                        ${{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>

                            <form action="{{ route('products.rate', $item->product_id) }}" method="POST"
                                class="rating-form">
                                @csrf
                                <input type="hidden" name="order_id" value="">

                                <div class="flex flex-col items-center">
                                    <!-- Star Rating -->
                                    <div class="flex justify-center space-x-1 mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                                class="star-rating transform hover:scale-110 transition-transform"
                                                data-rating="{{ $i }}">
                                                <i class='bx bx-star text-2xl text-gray-300'></i>
                                            </button>
                                        @endfor
                                        <input type="hidden" name="rating" value="0">
                                    </div>

                                    <!-- Rating Labels -->
                                    <div class="flex justify-between w-full text-xs text-gray-500 mb-3 px-2">
                                        <span>Poor</span>
                                        <span>Fair</span>
                                        <span>Good</span>
                                        <span>Very Good</span>
                                        <span>Excellent</span>
                                    </div>

                                    <button type="submit"
                                        class="w-full py-2 bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white rounded-lg text-sm font-medium transition flex items-center justify-center shadow-md">
                                        <i class='bx bx-check-circle mr-2'></i> Submit Rating
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button onclick="skipRating()"
                    class="p-2.5 text-sm font-medium text-purple-600 hover:text-purple-700 transition flex items-center justify-center">
                    Skip Rating
                </button>
            </div>
        </div>
    </div>

    <div id="loadingOverlay"
        class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center z-50 hidden">
        <div
            class="bg-white/90 p-8 rounded-2xl shadow-2xl flex flex-col items-center max-w-sm w-full mx-4 border border-white/20">
            <div class="relative h-16 w-16 mb-5">
                <div
                    class="absolute inset-0 rounded-full border-4 border-transparent border-t-blue-500 border-r-emerald-500 border-b-purple-500 border-l-amber-400 animate-spin">
                </div>
                <div
                    class="absolute inset-2 rounded-full border-4 border-transparent border-t-blue-400 border-r-emerald-400 border-b-purple-400 border-l-amber-300 animate-spin animation-delay-100">
                </div>
                <div class="absolute inset-1 rounded-full bg-white flex items-center justify-center">
                    <i class='bx bx-cart-alt text-2xl text-blue-600'></i>
                </div>
            </div>

            <h3 class="text-xl font-semibold text-gray-800 mb-1">Processing Payment</h3>
            <p class="text-gray-600 text-center mb-5">Please wait while we secure your transaction</p>

            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6 overflow-hidden relative">
                <div class="bg-gradient-to-r from-blue-500 to-emerald-500 h-2.5 rounded-full animate-progress"></div>
                <div id="progressPercentage" class="absolute top-0 right-0 text-xs text-gray-600 mt-3">0%</div>
            </div>

            <div class="flex items-center text-sm text-gray-500">
                <i class='bx bx-shield-alt text-blue-500 mr-2'></i>
                <span>Secure SSL Encryption</span>
            </div>
        </div>
    </div>

    <style>
        /* Your existing styles remain unchanged */

        /* New loading overlay styles */
        #loadingOverlay {
            transition: opacity 0.3s ease;
        }

        #loadingOverlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #loadingOverlay:not(.hidden) {
            opacity: 1;
        }

        .animate-progress {
            animation: progress 2.5s ease-in-out forwards;
        }

        @keyframes progress {
            0% {
                width: 0%;
            }

            80% {
                width: 90%;
            }

            100% {
                width: 100%;
            }
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

        /* Modal animations */
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

        @keyframes successModalBounce {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.9);
            }

            60% {
                transform: translateY(-10px) scale(1.05);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        #successModal.show {
            animation: successModalBounce 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        #successModal.hide {
            animation: modalSlideOut 0.3s ease-out forwards;
        }

        #ratingModal.show {
            animation: modalSlideIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        #ratingModal.hide {
            animation: modalSlideOut 0.3s ease-out forwards;
        }

        /* Star bounce animation */
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

        /* Loading animations */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes progress {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
        }

        .animate-spin {
            animation: spin 1.5s linear infinite;
        }

        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        .animate-progress {
            animation: progress 3s ease-out forwards;
        }

        /* Add these to your existing styles */
        #loadingOverlay {
            transition: opacity 0.3s ease;
        }

        #loadingOverlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #loadingOverlay:not(.hidden) {
            opacity: 1;
        }

        /* Make the progress bar animation smoother */
        .animate-progress {
            animation: progress 2.5s ease-in-out forwards;
        }

        @keyframes progress {
            0% {
                width: 0%;
            }

            80% {
                width: 90%;
            }

            100% {
                width: 100%;
            }
        }
    </style>

    <script>
        // Show success modal with animation
        function showSuccessModal() {
            const successModal = document.getElementById('successModal');
            successModal.classList.remove('hidden');
            successModal.classList.add('show');
        }

        // Close success modal and show rating modal with enhanced animation
        function closeSuccessModalAndShowRating() {
            const successModal = document.getElementById('successModal');
            const ratingModal = document.getElementById('ratingModal');

            // Animate out the success modal
            successModal.classList.remove('show');
            successModal.classList.add('hide');

            setTimeout(() => {
                successModal.classList.add('hidden');
                successModal.classList.remove('hide');

                // Show rating modal with animation
                ratingModal.classList.remove('hidden');
                ratingModal.classList.add('show');

                // Initialize star ratings
                initializeStarRatings();
            }, 300);
        }

        // Close rating modal with animation
        function closeRatingModal() {
            const ratingModal = document.getElementById('ratingModal');
            ratingModal.classList.remove('show');
            ratingModal.classList.add('hide');

            setTimeout(() => {
                ratingModal.classList.add('hidden');
                ratingModal.classList.remove('hide');
            }, 300);
        }

        // Skip rating and redirect to products page
        function skipRating() {
            closeRatingModal();
            setTimeout(() => {
                window.location.href = "{{ route('home') }}";
            }, 300);
        }

        // Initialize star ratings with enhanced animations
        function initializeStarRatings() {
            document.querySelectorAll('.star-rating').forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const form = this.closest('.rating-form');

                    // Add active class for animation
                    this.classList.add('active');
                    setTimeout(() => {
                        this.classList.remove('active');
                    }, 500);

                    // Update stars
                    this.parentElement.querySelectorAll('.star-rating i').forEach((icon, index) => {
                        if (index < rating) {
                            icon.classList.remove('bx-star', 'text-gray-300');
                            icon.classList.add('bxs-star', 'text-yellow-400');
                        } else {
                            icon.classList.remove('bxs-star', 'text-yellow-400');
                            icon.classList.add('bx-star', 'text-gray-300');
                        }
                    });

                    // Update hidden input
                    form.querySelector('input[name="rating"]').value = rating;
                });
            });
        }

        // Payment Method Toggle
        function showPaymentMethod(method) {
            // Hide all payment forms
            document.querySelectorAll('.payment-method').forEach(form => {
                form.classList.add('hidden');
            });

            // Show selected payment form
            document.getElementById(method + 'Form').classList.remove('hidden');

            // Update submit button target
            document.getElementById('submitButton').setAttribute('form', method + 'Form');

            // Update tab styling
            document.querySelectorAll('.payment-tab').forEach(tab => {
                if (tab.dataset.method === method) {
                    tab.classList.add('border-blue-500', 'text-blue-600');
                    tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                        'hover:border-gray-300');
                } else {
                    tab.classList.remove('border-blue-500', 'text-blue-600');
                    tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                        'hover:border-gray-300');
                }
            });

            // Change button for COD
            const submitButton = document.getElementById('submitButton');
            if (method === 'cod') {
                submitButton.innerHTML = `<i class='bx bx-package mr-2'></i> Place Order (COD)`;
                submitButton.classList.remove('from-blue-600', 'to-blue-700', 'hover:from-blue-700', 'hover:to-blue-800');
                submitButton.classList.add('from-green-600', 'to-green-700', 'hover:from-green-700', 'hover:to-green-800');
            } else {
                submitButton.innerHTML = `<i class='bx bx-lock-alt mr-2'></i> Pay ${{ number_format($total, 2) }}`;
                submitButton.classList.remove('from-green-600', 'to-green-700', 'hover:from-green-700',
                    'hover:to-green-800');
                submitButton.classList.add('from-blue-600', 'to-blue-700', 'hover:from-blue-700', 'hover:to-blue-800');
            }
        }

        // Form Submission Handler
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize payment method tabs
            showPaymentMethod('card'); // Default to card payment

            // Handle rating form submissions
            document.querySelectorAll('.rating-form').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    const formData = new FormData(this);

                    try {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML =
                            '<i class="bx bx-loader-alt animate-spin mr-2"></i> Submitting...';

                        const response = await fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            const productDiv = this.closest('.bg-gradient-to-br');
                            productDiv.innerHTML = `
                        <div class="text-center py-4">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-2">
                                <i class='bx bxs-check-circle text-xl text-green-500'></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">${data.message || 'Thank you for your feedback!'}</p>
                        </div>
                    `;

                            // Check if all ratings are submitted
                            const remainingForms = document.querySelectorAll(
                                '.rating-form:not(.hidden)');
                            if (remainingForms.length === 0) {
                                // Close modal and redirect after a delay
                                setTimeout(() => {
                                    closeRatingModal();
                                    window.location.href =
                                        "{{ route('home') }}";
                                }, 1500);
                            }
                        } else {
                            alert(data.message || 'Failed to submit rating');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred');
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                });
            });

            document.querySelectorAll('.payment-method').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const submitButton = document.getElementById('submitButton');
                    const originalButtonText = submitButton.innerHTML;
                    const loadingOverlay = document.getElementById('loadingOverlay');
                    const progressPercentage = document.getElementById('progressPercentage');

                    let progress = 0;
                    const progressInterval = setInterval(() => {
                        progress += 5;
                        if (progress > 90) progress = 90;
                        progressPercentage.textContent = `${progress}%`;
                    }, 100);

                    try {
                        // Show loading state
                        submitButton.disabled = true;
                        submitButton.innerHTML =
                            `<i class='bx bx-loader-alt animate-spin mr-2'></i> Processing...`;
                        loadingOverlay.classList.remove('hidden');

                        const startTime = Date.now();
                        const response = await fetch(this.action, {
                            method: 'POST',
                            body: new FormData(this),
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Payment failed');
                        }

                        // Ensure minimum 2.5s loading time
                        const elapsed = Date.now() - startTime;
                        const remainingDelay = Math.max(2500 - elapsed, 0);

                        // Complete progress animation
                        clearInterval(progressInterval);
                        progressPercentage.textContent = '100%';

                        // Add delays for smooth transition
                        await new Promise(resolve => setTimeout(resolve, remainingDelay + 300));
                        loadingOverlay.classList.add('hidden');
                        await new Promise(resolve => setTimeout(resolve, 300));

                        showSuccessModal();

                        document.querySelectorAll('.rating-form input[name="order_id"]')
                            .forEach(input => {
                                input.value = data.order_id;
                            });

                        if (typeof updateCartCount === 'function') {
                            updateCartCount(0);
                        }

                    } catch (error) {
                        clearInterval(progressInterval);
                        loadingOverlay.classList.add('hidden');
                        alert(error.message || 'An error occurred. Please try again.');
                    } finally {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    }
                });
            });
        });
    </script>
</x-app-layout>
