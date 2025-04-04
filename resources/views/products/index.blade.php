<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                                <i class='bx bx-home mr-2'></i>
                                Home
                            </a>
                        </li>

                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class='bx bx-chevron-right text-gray-400'></i>
                                <span class="ml-1 text-sm font-medium cursor-pointer text-indigo-600 md:ml-2">All
                                    Products</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="lg:w-1/4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-4">
                        <div class="flex justify-between items-center mb-6 pb-2 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-xl">Filters</h3>
                            {{-- <button class="text-sm text-indigo-600 hover:text-indigo-800">Reset All</button> --}}
                        </div>


                        <div class="mb-6">
                            <form method="GET" action="{{ route('products.index') }}">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Search products..."
                                        value="{{ request('search') }}"
                                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-300">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class='bx bx-search text-gray-400'></i>
                                    </div>
                                    @if (request('search'))
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <a href="{{ route('products.index') }}"
                                                class="text-gray-400 hover:text-gray-600">
                                                <i class='bx bx-x'></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>


                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-4">Price Range</h4>
                            <div class="px-2">
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm text-gray-500">$<span id="min-price-value">500</span></span>
                                    <span class="text-sm text-gray-500">$<span id="max-price-value">20000</span></span>
                                </div>
                                <div class="relative">
                                    <input type="range" id="price-range" min="500" max="5000" step="50"
                                        value="{{ $maxPrice ?? 5000 }}"
                                        class="w-full h-2 bg-indigo-100 rounded-lg appearance-none cursor-pointer">
                                </div>
                                <div class="flex justify-center mt-4">
                                    <div class="flex items-center space-x-2 bg-gray-50 px-4 py-2 rounded-lg">
                                        <span class="text-sm text-gray-600">Range:</span>
                                        <span class="font-medium text-indigo-600">
                                            $<span id="current-min-price">500</span> - $<span
                                                id="current-max-price">{{ $maxPrice ?? 5000 }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <!-- Brand Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center justify-between">
                                <span>Brands</span>
                                <i class='bx bx-chevron-down text-gray-500'></i>
                            </h4>
                            <ul class="space-y-2">
                                <li>
                                    <label
                                        class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                        <span class="text-gray-700">Apple</span>
                                        <span class="ml-auto text-gray-400 text-sm">(128)</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                        <span class="text-gray-700">Samsung</span>
                                        <span class="ml-auto text-gray-400 text-sm">(86)</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                        <span class="text-gray-700">Xiaomi</span>
                                        <span class="ml-auto text-gray-400 text-sm">(64)</span>
                                    </label>
                                </li>
                            </ul>
                        </div> --}}

                        <!-- Rating Filter -->
                        {{-- <div>
                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center justify-between">
                                <span>Customer Reviews</span>
                                <i class='bx bx-chevron-down text-gray-500'></i>
                            </h4>
                            <div class="space-y-2">
                                <label
                                    class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                    <input type="checkbox"
                                        class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex">
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                        </div>
                                        <span class="ml-2 text-gray-700">& Up</span>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                    <input type="checkbox"
                                        class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex">
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bx-star text-yellow-400'></i>
                                        </div>
                                        <span class="ml-2 text-gray-700">& Up</span>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg">
                                    <input type="checkbox"
                                        class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex">
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bxs-star text-yellow-400'></i>
                                            <i class='bx bx-star text-yellow-400'></i>
                                            <i class='bx bx-star text-yellow-400'></i>
                                        </div>
                                        <span class="ml-2 text-gray-700">& Up</span>
                                    </div>
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </aside>

                <!-- Main Product Section -->
                <main class="lg:w-3/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <!-- Header with sorting and view options -->
                        <div
                            class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-100">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    <span class="text-indigo-600">{{ $products->count() }}</span> Products Found
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">Based on your preferences</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-600">View:</span>
                                    <button class="p-2 rounded-lg bg-indigo-50 text-indigo-600">
                                        <i class='bx bx-grid-alt'></i>
                                    </button>
                                    <button class="p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                                        <i class='bx bx-list-ul'></i>
                                    </button>
                                </div>
                                <div class="relative">
                                    <select
                                        class="appearance-none bg-white border border-gray-200 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-300 text-sm"
                                        onchange="updateUrlParam('sort', this.value)">
                                        <option value="latest" {{ $currentSort == 'latest' ? 'selected' : '' }}>
                                            Sort by: Featured
                                        </option>
                                        <option value="price_asc" {{ $currentSort == 'price_asc' ? 'selected' : '' }}>
                                            Price: Low to High
                                        </option>
                                        <option value="price_desc" {{ $currentSort == 'price_desc' ? 'selected' : '' }}>
                                            Price: High to Low
                                        </option>
                                        <option value="rating" {{ $currentSort == 'rating' ? 'selected' : '' }}>
                                            Customer Rating
                                        </option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                        <i class='bx bx-chevron-down'></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($products->isEmpty())
                            <div class="text-center py-16">
                                <div class="inline-block p-6 bg-indigo-50 rounded-full mb-4">
                                    <i class='bx bx-package text-4xl text-indigo-600'></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-700 mb-2">No products found</h4>
                                <p class="text-gray-500 max-w-md mx-auto mb-6">We couldn't find any products matching
                                    your criteria. Try adjusting your filters or search for something else.</p>
                                <button
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                    Clear All Filters
                                </button>
                            </div>
                        @else
                            <!-- Product Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                                @foreach ($products as $product)
                                    <div
                                        class="group relative bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                                        <!-- Badge -->
                                        @if ($product->discount)
                                            <div
                                                class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                                -{{ $product->discount }}%
                                            </div>
                                        @endif

                                        <!-- Product Image -->
                                        <div class="relative overflow-hidden h-60 bg-gray-50">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                    class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105 p-4">
                                            </a>

                                            <!-- Quick Actions -->
                                            {{-- <div
                                                class="absolute inset-x-0 bottom-0 bg-white bg-opacity-90 backdrop-blur-sm p-3 flex justify-center space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <button
                                                    class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                    <i class='bx bx-heart text-xl'></i>
                                                </button>
                                                <button
                                                    class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                    <i class='bx bx-refresh text-xl'></i>
                                                </button>
                                                <button
                                                    class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                    <i class='bx bx-zoom-in text-xl'></i>
                                                </button>
                                            </div> --}}
                                        </div>

                                        <!-- Product Info -->
                                        <div class="p-4">
                                            <div class="flex items-center mb-2">
                                                @if ($product->ratings_count > 0)
                                                    <div class="flex items-center text-yellow-400">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($product->average_rating))
                                                                <i class='bx bxs-star'></i>
                                                            @elseif($i - 0.5 <= $product->average_rating)
                                                                <i class='bx bxs-star-half'></i>
                                                            @else
                                                                <i class='bx bx-star'></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span
                                                        class="text-xs text-gray-500 ml-1">({{ $product->ratings_count }}
                                                        reviews)</span>
                                                @else
                                                    <div class="flex items-center text-gray-300">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class='bx bx-star'></i>
                                                        @endfor
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">(No reviews yet)</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="font-semibold text-gray-900 mb-1 line-clamp-1 hover:text-indigo-600 block">
                                                {{ $product->title }}
                                            </a>
                                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">
                                                {{ $product->category }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    @if ($product->discount)
                                                        <span
                                                            class="text-lg font-bold text-gray-900">${{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                                        <span
                                                            class="text-sm text-gray-400 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                                                    @else
                                                        <span
                                                            class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <!-- Pagination -->
                            <div
                                class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                    {{ $products->total() }} results
                                </div>

                                <div class="flex items-center space-x-1">
                                    {{ $products->appends([
                                            'search' => request('search'),
                                            'min_price' => request('min_price'),
                                            'max_price' => request('max_price'),
                                        ])->onEachSide(1)->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </main>
            </div>
        </div>
    </div>

    <div id="loading-spinner"
        class="fixed inset-0 bg-white bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
    </div>

    <script>
        // Price Range Filter
        const priceRange = document.getElementById('price-range');
        const minPriceValue = document.getElementById('min-price-value');
        const maxPriceValue = document.getElementById('max-price-value');
        const currentMinPrice = document.getElementById('current-min-price');
        const currentMaxPrice = document.getElementById('current-max-price');
        let debounceTimer;

        // Initialize values
        maxPriceValue.textContent = priceRange.max;
        currentMaxPrice.textContent = priceRange.value;

        // Update display when slider moves
        priceRange.addEventListener('input', function() {
            currentMaxPrice.textContent = this.value;
        });

        // Fetch products when slider is released (with debounce)
        priceRange.addEventListener('change', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                updateFilters(0, this.value);
            }, 500);
        });

        // Search Filter
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter' || e.target.value.length === 0) {
                    updateFilters();
                }
            });
        }

        function updateFilters(minPrice = null, maxPrice = null) {
            // Get current URL parameters
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Update price parameters if provided
            if (minPrice !== null) params.set('min_price', minPrice);
            if (maxPrice !== null) params.set('max_price', maxPrice);

            // Update search parameter
            if (searchInput) {
                const searchValue = searchInput.value.trim();
                if (searchValue) {
                    params.set('search', searchValue);
                } else {
                    params.delete('search');
                }
            }

            // Remove page parameter to go back to first page
            params.delete('page');

            // Redirect with new parameters
            window.location.href = `${url.pathname}?${params.toString()}`;
        }

        // Function to update URL parameter for sorting
        function updateUrlParam(key, value) {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            if (value === 'latest') {
                params.delete(key);
            } else {
                params.set(key, value);
            }

            // Remove page parameter when changing sort
            params.delete('page');

            window.location.href = `${url.pathname}?${params.toString()}`;
        }
    </script>

    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>



    <x-footer />
</x-app-layout>
