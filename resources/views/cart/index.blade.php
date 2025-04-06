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
                    <!-- Order Summary Section -->
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

                            <form method="POST" action="{{ route('checkout') }}" class="mt-8" id="checkoutForm">
                                @csrf
                                <h3 class="text-lg font-semibold mb-6 flex items-center text-gray-800">
                                    <i class='bx bx-map text-blue-600 mr-2'></i> Shipping Information
                                </h3>

                                <div class="space-y-5">
                                    <!-- Address Line 1 -->
                                    <div class="relative">
                                        <label for="address_line_1"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-home-alt mr-1'></i> Street Address
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-buildings absolute left-3 top-3 text-gray-400'></i>
                                            <input type="text" id="address_line_1" name="address_line_1" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                placeholder="House/Building number, Street name"
                                                value="{{ old('address_line_1') }}">
                                        </div>
                                    </div>

                                    <!-- Region Selection -->
                                    <div class="relative">
                                        <label for="region" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-globe mr-1'></i> Region
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-map-pin absolute left-3 top-3 text-gray-400'></i>
                                            <select id="region" name="region" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none bg-white">
                                                <option value="">Select Region</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->code }}"
                                                        @if (old('region') == $region->code) selected @endif>
                                                        {{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <!-- Province Selection -->
                                    <div class="relative">
                                        <label for="province" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-map mr-1'></i> Province
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-map-alt absolute left-3 top-3 text-gray-400'></i>
                                            <select id="province" name="province" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none bg-white"
                                                @empty(old('province')) disabled @endempty>
                                                <option value="">Select Province</option>
                                                @if (old('province'))
                                                    @php
                                                        $selectedProvince = \App\Models\Province::where(
                                                            'code',
                                                            old('province'),
                                                        )->first();
                                                    @endphp
                                                    @if ($selectedProvince)
                                                        <option value="{{ $selectedProvince->code }}" selected>
                                                            {{ $selectedProvince->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            </select>

                                        </div>
                                    </div>

                                    <!-- City/Municipality Selection -->
                                    <div class="relative">
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-building-house mr-1'></i> City/Municipality
                                        </label>
                                        <div class="relative">
                                            <i class='bx bxs-city absolute left-3 top-3 text-gray-400'></i>
                                            <select id="city" name="city" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none bg-white"
                                                @empty(old('city')) disabled @endempty>
                                                <option value="">Select City/Municipality</option>
                                                @if (old('city'))
                                                    @php
                                                        $selectedCity = \App\Models\City::where(
                                                            'code',
                                                            old('city'),
                                                        )->first();
                                                    @endphp
                                                    @if ($selectedCity)
                                                        <option value="{{ $selectedCity->code }}" selected>
                                                            {{ $selectedCity->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Barangay Selection -->
                                    <div class="relative">
                                        <label for="barangay" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-current-location mr-1'></i> Barangay
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-location-plus absolute left-3 top-3 text-gray-400'></i>
                                            <select id="barangay" name="barangay" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none bg-white"
                                                @empty(old('barangay')) disabled @endempty>
                                                <option value="">Select Barangay</option>
                                                @if (old('barangay'))
                                                    @php
                                                        $selectedBarangay = \App\Models\Barangay::where(
                                                            'code',
                                                            old('barangay'),
                                                        )->first();
                                                    @endphp
                                                    @if ($selectedBarangay)
                                                        <option value="{{ $selectedBarangay->code }}" selected>
                                                            {{ $selectedBarangay->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            </select>

                                        </div>
                                    </div>

                                    <!-- Zip Code -->
                                    <div class="relative">
                                        <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-mail-send mr-1'></i> Zip Code
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-barcode absolute left-3 top-3 text-gray-400'></i>
                                            <input type="text" id="zip_code" name="zip_code" required
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                                value="{{ old('zip_code') }}">
                                        </div>
                                    </div>

                                    <!-- Shipping Method -->
                                    <div class="relative">
                                        <label for="shipping_method"
                                            class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class='bx bx-truck mr-1'></i> Shipping Method
                                        </label>
                                        <div class="relative">
                                            <i class='bx bx-package absolute left-3 top-3 text-gray-400'></i>
                                            <select id="shipping_method" name="shipping_method"
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none bg-white">
                                                <option value="Standard Shipping"
                                                    @if (old('shipping_method', 'Standard Shipping') == 'Standard Shipping') selected @endif>
                                                    Standard Shipping (5-7 business days)
                                                </option>
                                                <option value="Express Shipping"
                                                    @if (old('shipping_method') == 'Express Shipping') selected @endif>
                                                    Express Shipping (2-3 business days)
                                                </option>
                                                <option value="Overnight Shipping"
                                                    @if (old('shipping_method') == 'Overnight Shipping') selected @endif>
                                                    Overnight Shipping (1 business day)
                                                </option>
                                            </select>
                                            <i
                                                class='bx bx-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none'></i>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" id="checkout-button"
                                    class="mt-8 w-full bg-gray-800 text-white py-3 rounded-lg font-bold hover:bg-gray-900 transition-all shadow-md flex items-center justify-center">
                                    <i class='bx bx-lock-alt text-xl mr-2'></i> Proceed to Checkout
                                </button>
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

            // ================ ADDRESS PERSISTENCE ================

            // Store form data in sessionStorage
            function storeFormData() {
                const formData = {
                    address_line_1: document.getElementById('address_line_1').value,
                    region: document.getElementById('region').value,
                    province: document.getElementById('province').value,
                    city: document.getElementById('city').value,
                    barangay: document.getElementById('barangay').value,
                    zip_code: document.getElementById('zip_code').value,
                    shipping_method: document.getElementById('shipping_method').value
                };
                sessionStorage.setItem('shippingFormData', JSON.stringify(formData));
            }

            // Add event listeners to all form inputs
            document.querySelectorAll('#checkoutForm input, #checkoutForm select').forEach(input => {
                input.addEventListener('change', storeFormData);
                input.addEventListener('input', storeFormData);
            });

            // Restore form data from sessionStorage
            function restoreFormData() {
                const savedFormData = sessionStorage.getItem('shippingFormData');
                if (savedFormData) {
                    const formData = JSON.parse(savedFormData);

                    // Restore simple fields
                    document.getElementById('address_line_1').value = formData.address_line_1 || '';
                    document.getElementById('zip_code').value = formData.zip_code || '';
                    document.getElementById('shipping_method').value = formData.shipping_method ||
                        'Standard Shipping';

                    // Only restore region if it exists in the select options
                    const regionSelect = document.getElementById('region');
                    if (formData.region && Array.from(regionSelect.options).some(opt => opt.value === formData
                            .region)) {
                        regionSelect.value = formData.region;

                        // Trigger region change to load provinces
                        const event = new Event('change');
                        regionSelect.dispatchEvent(event);

                        // Restore province after provinces are loaded
                        setTimeout(() => {
                            const provinceSelect = document.getElementById('province');
                            if (formData.province && provinceSelect) {
                                // Wait until the province is available in the options
                                const checkProvince = setInterval(() => {
                                    const provinceOption = Array.from(provinceSelect.options).find(
                                        opt => opt.value === formData.province);
                                    if (provinceOption) {
                                        provinceSelect.value = formData.province;
                                        provinceSelect.dispatchEvent(event);
                                        clearInterval(checkProvince);

                                        // Restore city after cities are loaded
                                        setTimeout(() => {
                                            const citySelect = document.getElementById(
                                                'city');
                                            if (formData.city && citySelect) {
                                                const checkCity = setInterval(() => {
                                                    const cityOption = Array.from(
                                                            citySelect.options)
                                                        .find(opt => opt.value ===
                                                            formData.city);
                                                    if (cityOption) {
                                                        citySelect.value = formData
                                                            .city;
                                                        citySelect.dispatchEvent(
                                                            event);
                                                        clearInterval(checkCity);

                                                        // Restore barangay after barangays are loaded
                                                        setTimeout(() => {
                                                            const
                                                                barangaySelect =
                                                                document
                                                                .getElementById(
                                                                    'barangay'
                                                                );
                                                            if (formData
                                                                .barangay &&
                                                                barangaySelect
                                                            ) {
                                                                const
                                                                    checkBarangay =
                                                                    setInterval(
                                                                        () => {
                                                                            const
                                                                                barangayOption =
                                                                                Array
                                                                                .from(
                                                                                    barangaySelect
                                                                                    .options
                                                                                )
                                                                                .find(
                                                                                    opt =>
                                                                                    opt
                                                                                    .value ===
                                                                                    formData
                                                                                    .barangay
                                                                                );
                                                                            if (
                                                                                barangayOption
                                                                            ) {
                                                                                barangaySelect
                                                                                    .value =
                                                                                    formData
                                                                                    .barangay;
                                                                                clearInterval
                                                                                    (
                                                                                        checkBarangay
                                                                                    );
                                                                            }
                                                                        },
                                                                        100
                                                                    );
                                                            }
                                                        }, 300);
                                                    }
                                                }, 100);
                                            }
                                        }, 300);
                                    }
                                }, 100);
                            }
                        }, 300);
                    }
                }
            }

            // ================ ADDRESS SELECT HANDLING ================

            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const citySelect = document.getElementById('city');
            const barangaySelect = document.getElementById('barangay');
            const zipCodeInput = document.getElementById('zip_code');

            // Region change handler
            if (regionSelect) {
                regionSelect.addEventListener('change', function() {
                    const regionCode = this.value;

                    // Reset downstream selects
                    provinceSelect.innerHTML = '<option value="">Select Province</option>';
                    provinceSelect.disabled = !regionCode;
                    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
                    citySelect.disabled = true;
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    barangaySelect.disabled = true;
                    zipCodeInput.value = '';

                    if (!regionCode) return;

                    // Fetch provinces for selected region
                    fetch(`/provinces?region_code=${regionCode}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(province => {
                                const option = document.createElement('option');
                                option.value = province.code;
                                option.textContent = province.name;
                                provinceSelect.appendChild(option);
                            });
                            provinceSelect.disabled = false;
                            storeFormData();
                        });
                });
            }

            // Province change handler
            if (provinceSelect) {
                provinceSelect.addEventListener('change', function() {
                    const provinceCode = this.value;

                    // Reset downstream selects
                    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
                    citySelect.disabled = !provinceCode;
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    barangaySelect.disabled = true;
                    zipCodeInput.value = '';

                    if (!provinceCode) return;

                    // Fetch cities for selected province
                    fetch(`/cities?province_code=${provinceCode}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.code;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                            citySelect.disabled = false;
                            storeFormData();
                        });
                });
            }

            // City change handler
            if (citySelect) {
                citySelect.addEventListener('change', function() {
                    const cityCode = this.value;

                    // Reset downstream selects
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    barangaySelect.disabled = !cityCode;
                    zipCodeInput.value = '';

                    if (!cityCode) return;

                    // Fetch barangays for selected city
                    fetch(`/barangays?city_code=${cityCode}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(barangay => {
                                const option = document.createElement('option');
                                option.value = barangay.code;
                                option.textContent = barangay.name;
                                barangaySelect.appendChild(option);
                            });
                            barangaySelect.disabled = false;
                            storeFormData();
                        });

                    // Try to fetch zip code for the city
                    fetch(`/cities/${cityCode}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.zip_code) {
                                zipCodeInput.value = data.zip_code;
                                storeFormData();
                            }
                        });
                });
            }

            // ================ CART FUNCTIONALITY ================

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
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const quantityInput = document.querySelector(
                                `.quantity-input[data-id="${productId}"]`);
                            if (quantityInput) quantityInput.value = data.quantity;

                            const priceElement = document.querySelector(`.item-price[data-id="${productId}"]`);
                            if (priceElement) priceElement.textContent = `$${data.price}`;

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
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`.cart-item[data-id="${productId}"]`)?.remove();
                            updateOrderSummary(data);

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

            // Form Submission Handler
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;

                    submitButton.innerHTML = '<i class="bx bx-loader bx-spin mr-2"></i> Processing...';
                    submitButton.disabled = true;

                    setTimeout(() => {
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

                                if (contentType && contentType.includes(
                                        'application/json')) {
                                    const data = await response.json();

                                    if (!response.ok) {
                                        if (data.errors) {
                                            let errorMessages = Object.values(data.errors)
                                                .flat().join(
                                                    '\n');
                                            throw new Error(errorMessages);
                                        }
                                        throw new Error(data.message ||
                                            'An error occurred');
                                    }

                                    if (data.redirect) {
                                        // Clear saved form data when successfully proceeding to checkout
                                        sessionStorage.removeItem('shippingFormData');
                                        window.location.href = data.redirect;
                                    }
                                    return;
                                }

                                const text = await response.text();
                                if (response.redirected) {
                                    sessionStorage.removeItem('shippingFormData');
                                    window.location.href = response.url;
                                    return;
                                }

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
                    }, 2500);
                });
            }

            // Initialize form data restoration
            restoreFormData();
        });
    </script>
</x-app-layout>
