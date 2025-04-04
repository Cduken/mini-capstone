<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center text-sm text-gray-600 mb-8">
                <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors flex items-center">
                    <i class='bx bx-home mr-1'></i> Home
                </a>
                <i class='bx bx-chevron-right mx-2 text-gray-400'></i>
                <span class="text-gray-900 font-medium">Shopping Cart</span>
            </nav>

            <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg flex items-center">
                    <i class='bx bx-check-circle text-xl mr-2'></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items Section -->
                <div class="lg:w-2/3">
                    @if ($cartItems->isNotEmpty())
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <!-- Cart Items Header -->
                            <div class="hidden md:grid grid-cols-12 bg-gray-50 p-4 border-b">
                                <div class="col-span-5 font-medium text-gray-700">Product</div>
                                <div class="col-span-3 font-medium text-gray-700 text-center">Quantity</div>
                                <div class="col-span-3 font-medium text-gray-700 text-right">Price</div>
                                <div class="col-span-1"></div>
                            </div>

                            <!-- Cart Items List -->
                            <div class="divide-y divide-gray-200">
                                @foreach ($cartItems as $item)
                                    <div class="p-4 md:p-6 flex flex-col md:flex-row md:items-center cart-item"
                                        data-id="{{ $item->product_id }}">
                                        <!-- Product Image & Info -->
                                        <div class="flex items-center md:w-5/12 mb-4 md:mb-0">
                                            <div class="relative w-20 h-20 flex-shrink-0 overflow-hidden rounded-lg">
                                                <img src="{{ asset($item->product->image ?? 'default.jpg') }}"
                                                    alt="{{ $item->product->title ?? 'Product' }}"
                                                    class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black bg-opacity-5"></div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-md font-medium text-gray-900">
                                                    {{ $item->product->title ?? 'N/A' }}</h3>
                                                <p class="text-sm text-gray-500 mt-1">SKU: #{{ $item->product_id }}</p>
                                            </div>
                                        </div>

                                        <!-- Quantity Selector -->
                                        <div
                                            class="flex items-center justify-between md:justify-center md:w-3/12 mb-4 md:mb-0">
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button
                                                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 update-quantity"
                                                    data-id="{{ $item->product_id }}" data-action="minus">
                                                    −
                                                </button>
                                                <input type="text" value="{{ $item->quantity ?? 1 }}"
                                                    class="w-12 h-8 text-center border-x border-gray-300 bg-transparent quantity-input"
                                                    data-id="{{ $item->product_id }}">
                                                <button
                                                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 update-quantity"
                                                    data-id="{{ $item->product_id }}" data-action="plus">
                                                    +
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div
                                            class="flex items-center justify-between md:justify-end md:w-3/12 mb-4 md:mb-0">
                                            <span class="md:hidden text-sm font-medium text-gray-500">Price:</span>
                                            <span class="text-md font-semibold text-gray-900 item-price"
                                                data-id="{{ $item->product_id }}">
                                                ${{ number_format(($item->price ?? 0) * ($item->quantity ?? 1), 2) }}
                                            </span>
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="flex justify-end md:w-1/12">
                                            <button
                                                class="text-gray-400 hover:text-red-500 transition-colors remove-item"
                                                data-id="{{ $item->product_id }}">
                                                <i class='bx bx-trash text-xl'></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Continue Shopping Button -->
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <i class='bx bx-chevron-left mr-1'></i> Continue Shopping
                            </a>
                        </div>
                    @else
                        <!-- Empty Cart State -->
                        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                            <div
                                class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class='bx bx-cart text-3xl text-gray-400'></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h3>
                            <p class="text-gray-500 mb-6">Start shopping to add items to your cart</p>
                            <a href="{{ route('products.index') }}"
                                class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors inline-flex items-center">
                                <i class='bx bx-shopping-bag mr-2'></i> Shop Now
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Order Summary Section -->
                @if ($cartItems->isNotEmpty())
                    <div class="lg:w-1/3">
                        <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span
                                        class="font-medium subtotal-amount">${{ number_format($subtotal ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Estimated Tax</span>
                                    <span class="font-medium tax-amount">${{ number_format($tax ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span
                                        class="font-medium shipping-amount">${{ number_format($shipping ?? 0, 2) }}</span>
                                </div>

                                <div class="border-t border-gray-200 pt-4 mt-2">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span class="total-amount">${{ number_format($total ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Form -->
                            <form method="POST" action="{{ route('checkout') }}" class="mt-8">
                                @csrf
                                <h3 class="text-lg font-semibold mb-4 flex items-center">
                                    <i class='bx bx-map mr-2'></i> Shipping Information
                                </h3>

                                <div class="space-y-4">
                                    <div>
                                        <label for="address_line_1"
                                            class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <input type="text" id="address_line_1" name="address_line_1" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="city"
                                                class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                            <input type="text" id="city" name="city" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        </div>
                                        <div>
                                            <label for="zip_code"
                                                class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                                            <input type="text" id="zip_code" name="zip_code" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="country"
                                                class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                            <select id="country" name="country" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                                <option value="">Select Country</option>
                                                <option value="US">United States</option>
                                                <option value="CA">Canada</option>
                                                <option value="UK">United Kingdom</option>
                                                <option value="PH">Philippines</option>
                                                <option value="MX">Mexico</option>
                                                <option value="IN">India</option>
                                                <option value="CN">China</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="JP">Japan</option>
                                                <option value="BR">Brazil</option>
                                                <option value="RU">Russia</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="state"
                                                class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                            <input type="text" id="state" name="state" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="shipping_method"
                                            class="block text-sm font-medium text-gray-700 mb-1">Shipping
                                            Method</label>
                                        <select id="shipping_method" name="shipping_method"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                            <option value="Standard Shipping">Standard Shipping (5-7 business days)
                                            </option>
                                            <option value="Express Shipping">Express Shipping (2-3 business days)
                                            </option>
                                            <option value="Overnight Shipping">Overnight Shipping (1 business day)
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" id="checkout-button"
                                    class="mt-6 w-full bg-gradient-to-r from-gray-700 to-gray-900 text-white py-3 rounded-lg font-bold hover:from-gray-800 hover:to-gray-900 transition-all shadow-md flex items-center justify-center">
                                    <i class='bx bx-lock-alt mr-2'></i> Proceed to Checkout
                                </button>

                                <p class="mt-4 text-center text-sm text-gray-500">
                                    <i class='bx bx-shield-alt text-gray-400 mr-1'></i> Secure checkout
                                </p>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex items-center mb-4">
                <div class="bg-red-100 p-3 rounded-full mr-3">
                    <i class='bx bx-trash text-red-600 text-xl'></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Remove Item</h3>
            </div>
            <p class="text-gray-600 mb-6">Are you sure you want to remove this item from your cart?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDelete"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button id="confirmDelete"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Remove Item
                </button>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteBtn = document.getElementById('cancelDelete');
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            const checkoutForm = document.querySelector('form[action="{{ route('checkout') }}"]');

            let currentProductIdToDelete = null;

            // Handle Quantity Updates
            document.querySelectorAll('.update-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    let productId = this.getAttribute('data-id');
                    let action = this.getAttribute('data-action');
                    let quantityInput = document.querySelector(
                        `.quantity-input[data-id="${productId}"]`);
                    let quantity = parseInt(quantityInput.value) || 1;

                    if (action === 'plus') quantity += 1;
                    else if (action === 'minus' && quantity > 1) quantity -= 1;

                    updateCart(productId, quantity);
                });
            });

            // Handle Direct Quantity Input Change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    let productId = this.getAttribute('data-id');
                    let quantity = parseInt(this.value) || 1;
                    if (quantity < 1) quantity = 1;
                    this.value = quantity;
                    updateCart(productId, quantity);
                });
            });

            // Handle Removing Items - Show Modal
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    currentProductIdToDelete = this.getAttribute('data-id');
                    deleteModal.classList.remove('hidden');
                });
            });

            // Handle Cancel Delete
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
                currentProductIdToDelete = null;
            });

            // Handle Confirm Delete
            confirmDeleteBtn.addEventListener('click', function() {
                if (currentProductIdToDelete) {
                    removeItem(currentProductIdToDelete);
                    deleteModal.classList.add('hidden');
                    currentProductIdToDelete = null;
                }
            });

            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                    currentProductIdToDelete = null;
                }
            });

            // AJAX Function for Updating Cart
            function updateCart(productId, quantity) {
                fetch(`/cart/update/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`.quantity-input[data-id="${productId}"]`).value = data
                                .quantity;
                            document.querySelector(`.item-price[data-id="${productId}"]`).textContent =
                                `$${data.price}`;
                            updateOrderSummary(data);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating cart:', error);
                        alert('An error occurred while updating the cart');
                    });
            }

            // AJAX Function for Removing Items
            function removeItem(productId) {
                fetch(`/cart/remove/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`.cart-item[data-id="${productId}"]`)?.remove();
                            updateOrderSummary(data);

                            // If cart is now empty, reload the page to show empty state
                            if (document.querySelectorAll('.cart-item').length === 0) {
                                location.reload();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error removing item:', error);
                        alert('An error occurred while removing the item');
                    });
            }

            // Update Order Summary
            function updateOrderSummary(data) {
                if (data.subtotal !== undefined) {
                    document.querySelector('.subtotal-amount').textContent = `$${data.subtotal}`;
                }
                if (data.tax !== undefined) {
                    document.querySelector('.tax-amount').textContent = `$${data.tax}`;
                }
                if (data.shipping !== undefined) {
                    document.querySelector('.shipping-amount').textContent = `$${data.shipping}`;
                }
                if (data.total !== undefined) {
                    document.querySelector('.total-amount').textContent = `$${data.total}`;
                }
            }

            // Update your form submission handler
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;

                    // Show loading state
                    submitButton.innerHTML = '<i class="bx bx-loader bx-spin mr-2"></i> Processing...';
                    submitButton.disabled = true;

                    fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        })
                        .then(async response => {
                            const contentType = response.headers.get('content-type');

                            // Handle JSON response
                            if (contentType && contentType.includes('application/json')) {
                                const data = await response.json();

                                if (!response.ok) {
                                    // Handle validation errors
                                    if (data.errors) {
                                        let errorMessages = Object.values(data.errors).flat().join(
                                            '\n');
                                        throw new Error(errorMessages);
                                    }
                                    throw new Error(data.message || 'An error occurred');
                                }

                                // Handle successful response
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                                return;
                            }

                            // Handle HTML response (fallback for non-JSON responses)
                            const text = await response.text();

                            // Check if this is a redirect in HTML (Laravel sometimes does this)
                            if (response.redirected) {
                                window.location.href = response.url;
                                return;
                            }

                            // If we got HTML but expected JSON, something went wrong
                            throw new Error('Server returned unexpected response');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error: ' + error.message);
                        })
                        .finally(() => {
                            submitButton.innerHTML = originalButtonText;
                            submitButton.disabled = false;
                        });
                });
            }
        });
    </script>
</x-app-layout>
