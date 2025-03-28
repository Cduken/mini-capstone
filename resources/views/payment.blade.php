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
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab"
                                    data-method="card">
                                    <i class='bx bx-credit-card mr-2'></i> Credit/Debit Card
                                </button>
                                <button type="button" onclick="showPaymentMethod('gcash')"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab"
                                    data-method="gcash">
                                    <i class='bx bx-wallet mr-2'></i> GCash
                                </button>
                                <button type="button" onclick="showPaymentMethod('cod')"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center payment-tab"
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

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col-reverse sm:flex-row justify-between gap-4">
                            <a href="{{ url()->previous() }}"
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
                            <p class="text-sm text-gray-600">{{ $address }}</p>
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

    <!-- Success Modal (hidden by default) -->
    <div id="successModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-md h-auto max-h-[100vh] flex flex-col">
            <!-- Modal Header -->
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-6 text-center relative">
                <div class="absolute top-2 left-1/2 transform -translate-x-1/2">
                    <div class="h-10 w-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <h1 class="mt-6 text-xl font-bold text-white">Payment Successful!</h1>
                <p class="mt-1 text-emerald-100 text-sm">Order #<span id="orderNumber">{{ rand(1000, 9999) }}</span>
                </p>
            </div>

            <!-- Modal Content - Compact Layout -->
            <div class="p-6 flex-1 flex flex-col overflow-hidden">
                <div class="text-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Thank you for your order!</h2>

                    <!-- Delivery Estimate - More Compact -->
                    <div class="mt-3 bg-emerald-50/50 rounded-lg p-2 inline-flex items-center mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path
                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h3.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z" />
                        </svg>
                        <span class="text-xs font-medium text-gray-700">Delivery:
                            {{ now()->addDays(3)->format('M j') }}</span>
                    </div>
                </div>

                <!-- Order Summary - More Compact -->
                <div class="border-t border-gray-100 pt-4 flex-1 overflow-y-auto">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Receipt</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span>$<span id="modalSubtotal">{{ number_format($subtotal, 2) }}</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span>$<span id="modalShipping">{{ number_format($shipping, 2) }}</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span>$<span id="modalTax">{{ number_format($tax, 2) }}</span></span>
                        </div>
                        <div class="flex justify-between pt-2 mt-2 border-t border-gray-100 font-bold">
                            <span class="text-gray-800">Total</span>
                            <span class="text-emerald-600">$<span
                                    id="modalTotal">{{ number_format($total, 2) }}</span></span>
                        </div>
                    </div>
                </div>


                <div class="mt-4 space-y-2">
                    <a href="{{ route('products.index') }}"
                        class="block px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-center text-sm font-medium">
                        Continue Shopping
                    </a>
                    <div class="flex space-x-2">
                        <a href="#" id="orderDetailsLink"
                            class="flex-1 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-center text-sm font-medium">
                            Details
                        </a>
                        <button onclick="window.print()"
                            class="flex-1 px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const forms = document.querySelectorAll('.payment-method');
            forms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitButton = document.getElementById('submitButton');
                    const originalButtonText = submitButton.innerHTML;

                    try {

                        submitButton.disabled = true;
                        submitButton.innerHTML =
                            `<i class='bx bx-loader-alt animate-spin mr-2'></i> Processing...`;

                        await new Promise(resolve => setTimeout(resolve, 3000));


                        const response = await fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Show success modal
                            const modal = document.getElementById('successModal');
                            modal.classList.remove('hidden');

                            // Update order number in modal
                            document.getElementById('orderNumber').textContent = data.order_id;

                            // Update the "View Order Details" button link
                            const orderDetailsLink = document.getElementById(
                                'orderDetailsLink');
                            orderDetailsLink.href = `/my-orders/${data.order_id}`;

                            // Clear cart and session data
                            await fetch('{{ route('payment.clear') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                        } else {
                            alert(data.message || 'Payment failed. Please try again.');
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    } finally {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    }
                });
            });
        });

        function showPaymentMethod(method) {
            // Hide all payment forms
            document.querySelectorAll('.payment-method').forEach(form => {
                form.classList.add('hidden');
            });

            // Show selected payment form
            document.getElementById(method + 'Form').classList.remove('hidden');

            // Update the submit button to target the correct form
            document.getElementById('submitButton').setAttribute('form', method + 'Form');

            // Update active tab styling
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

            // Change button text for COD
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
    </script>
</x-app-layout>
