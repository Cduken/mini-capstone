<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-sm font-medium">
                    <li class="flex items-center">
                        <a href="{{ route('home') }}"
                            class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors">
                            <i class='bx bx-home mr-2'></i>
                            Home
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class='bx bx-chevron-right text-gray-400'></i>
                        <span class="ml-2 text-indigo-600">All Products</span>
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="lg:w-1/4">
                    <div
                        class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-neumorphic border border-gray-100 sticky top-4 transition-all duration-300">
                        <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200/50">
                            <h3 class="text-xl font-semibold text-gray-900">Filters</h3>
                            <button onclick="resetFilters()"
                                class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors">Reset
                                All</button>
                        </div>

                        <!-- Search -->
                        <div class="mb-6">
                            <form method="GET" action="{{ route('products.index') }}" id="search-form">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Search products..."
                                        value="{{ request('search') }}"
                                        class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-300 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-400"
                                        aria-label="Search products">
                                    <i
                                        class='bx bx-search text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2'></i>
                                    @if (request('search'))
                                        <a href="{{ route('products.index') }}"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                            <i class='bx bx-x'></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <button
                                class="w-full flex justify-between items-center font-semibold text-gray-800 mb-4 focus:outline-none"
                                onclick="toggleFilter('price-filter')">
                                <span>Price Range</span>
                                <i class='bx bx-chevron-down text-gray-500 transition-transform duration-300'></i>
                            </button>
                            <div id="price-filter" class="space-y-4">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>₱<span id="min-price-value">100</span></span>
                                    <span>₱<span id="max-price-value">5000</span></span>
                                </div>
                                <div class="relative">
                                    <input type="range" id="min-price" min="100" max="5000" step="50"
                                        value="{{ request('min_price') ?? 100 }}"
                                        class="w-full h-2 bg-indigo-100 rounded-lg cursor-pointer accent-indigo-600">
                                    <input type="range" id="max-price" min="100" max="5000" step="50"
                                        value="{{ request('max_price') ?? 5000 }}"
                                        class="w-full h-2 bg-indigo-100 rounded-lg cursor-pointer accent-indigo-600">
                                </div>
                                <div class="flex justify-center">
                                    <div class="bg-indigo-50 px-4 py-2 rounded-xl text-sm font-medium text-indigo-700">
                                        ₱<span id="current-min-price">{{ request('min_price') ?? 100 }}</span> - ₱<span
                                            id="current-max-price">{{ request('max_price') ?? 5000 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Rating Filter -->
                        <div>
                            <button
                                class="w-full flex justify-between items-center font-semibold text-gray-800 mb-4 focus:outline-none"
                                onclick="toggleFilter('rating-filter')">
                                <span>Customer Reviews</span>
                                <i class='bx bx-chevron-down text-gray-500 transition-transform duration-300'></i>
                            </button>
                            <div id="rating-filter" class="space-y-2 hidden">
                                @foreach ([5, 4, 3] as $rating)
                                    <label
                                        class="flex items-center space-x-3 cursor-pointer hover:bg-indigo-50 p-2 rounded-lg transition-colors">
                                        <input type="checkbox" name="ratings[]" value="{{ $rating }}"
                                            class="form-checkbox h-5 w-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-300"
                                            {{ in_array($rating, (array) request('ratings', [])) ? 'checked' : '' }}>
                                        <div class="flex items-center">
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class='bx {{ $i <= $rating ? 'bxs-star' : 'bx-star' }}'></i>
                                                @endfor
                                            </div>
                                            <span class="ml-2 text-gray-700">& Up</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Main Product Section -->
                <main class="lg:w-3/4">
                    <div
                        class="bg-white/90 backdrop-blur-md rounded-2xl shadow-neumorphic border border-gray-100 overflow-hidden">
                        <!-- Header -->
                        <div
                            class="flex flex-col md:flex-row md:items-center md:justify-between p-6 border-b border-gray-200/50">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    <span class="text-indigo-600">{{ $products->count() }}</span> Products Found
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">Based on your preferences</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-600">View:</span>
                                    <button
                                        class="p-2 rounded-xl bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors"
                                        onclick="toggleView('grid')">
                                        <i class='bx bx-grid-alt'></i>
                                    </button>
                                    <button class="p-2 rounded-xl hover:bg-gray-100 text-gray-600 transition-colors"
                                        onclick="toggleView('list')">
                                        <i class='bx bx-list-ul'></i>
                                    </button>
                                </div>
                                <div class="relative">
                                    <select
                                        class="appearance-none bg-white border border-gray-200 rounded-xl pl-4 pr-10 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-transparent text-sm transition-all duration-200 text-gray-900"
                                        onchange="updateUrlParam('sort', this.value)">
                                        <option value="latest" {{ $currentSort == 'latest' ? 'selected' : '' }}>
                                            Sort by: Featured
                                        </option>
                                        <option value="price_asc" {{ $currentSort == 'price_asc' ? 'selected' : '' }}>
                                            Price: Low to High
                                        </option>
                                        <option value="price_desc"
                                            {{ $currentSort == 'price_desc' ? 'selected' : '' }}>
                                            Price: High to Low
                                        </option>
                                        <option value="rating" {{ $currentSort == 'rating' ? 'selected' : '' }}>
                                            Customer Rating
                                        </option>
                                    </select>
                                    <i
                                        class='bx bx-chevron-down text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2'></i>
                                </div>
                            </div>
                        </div>

                        <!-- No Products -->
                        @if ($products->isEmpty())
                            <div class="text-center py-16">
                                <div class="inline-block p-6 bg-indigo-100 rounded-full mb-4 animate-pulse">
                                    <i class='bx bx-package text-4xl text-indigo-600'></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-700 mb-2">No products found</h4>
                                <p class="text-gray-500 max-w-md mx-auto mb-6">Try adjusting your filters or search for
                                    something else.</p>
                                <button onclick="resetFilters()"
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors font-medium">
                                    Clear All Filters
                                </button>
                            </div>
                        @else
                            <!-- Product Grid/List -->
                            <div id="product-container"
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6 transition-all duration-300">
                                @foreach ($products as $product)
                                    <div
                                        class="group relative bg-white/90 rounded-xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-neumorphic transition-all duration-300 hover:-translate-y-1">
                                        <!-- Badge -->
                                        @if ($product->discount)
                                            <div
                                                class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10 animate-pulse">
                                                -{{ $product->discount }}%
                                            </div>
                                        @endif


                                        <div class="relative overflow-hidden h-60 bg-gray-50">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                    class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105 p-4 lazy-load"
                                                    loading="lazy">
                                            </a>

                                            <div
                                                class="absolute inset-x-0 bottom-0 bg-white/80 backdrop-blur-md p-3 flex justify-center space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <form action="{{ route('wishlist.add', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                                                        <i class='bx bx-heart text-xl'></i>
                                                    </button>
                                                </form>

                                                <button
                                                    class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                                                    <i class='bx bx-refresh text-xl'></i>
                                                </button>
                                                <button
                                                    class="p-2 rounded-full bg-white shadow-md hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                                                    <i class='bx bx-zoom-in text-xl'></i>
                                                </button>
                                            </div>
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
                                                    <span class="text-xs text-gray-500 ml-1">(No reviews)</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="font-semibold text-gray-900 mb-1 line-clamp-1 hover:text-indigo-600 transition-colors">
                                                {{ $product->title }}
                                            </a>
                                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">
                                                {{ $product->category }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    @if ($product->discount)
                                                        <span
                                                            class="text-lg font-bold text-gray-900">₱{{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                                                        <span
                                                            class="text-sm text-gray-400 line-through ml-2">₱{{ number_format($product->price, 2) }}</span>
                                                    @else
                                                        <span
                                                            class="text-lg font-bold text-gray-900">₱{{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                                {{-- <button
                                                    class="px-3 py-1 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors">
                                                    Add to Cart
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div
                                class="px-6 py-4 border-t border-gray-200/50 bg-gray-50 flex items-center justify-between">
                                <div class="text-sm text-gray-600">
                                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                    {{ $products->total() }} results
                                </div>
                                <div class="flex items-center space-x-1">
                                    {{ $products->appends([
                                            'search' => request('search'),
                                            'min_price' => request('min_price'),
                                            'max_price' => request('max_price'),
                                            'sort' => request('sort'),
                                            'ratings' => request('ratings'),
                                        ])->onEachSide(1)->links('vendor.pagination.custom') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </main>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loading-spinner"
            class="fixed inset-0 bg-white/70 backdrop-blur-md flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-600"></div>
        </div>

        <!-- Mobile Filter Toggle -->
        <button id="mobile-filter-toggle"
            class="lg:hidden fixed bottom-6 right-6 bg-indigo-600 text-white p-4 rounded-full shadow-lg hover:bg-indigo-700 transition-colors">
            <i class='bx bx-filter-alt'></i>
        </button>
    </div>
    <script>
        // Toggle filter sections
        function toggleFilter(id) {
            const section = document.getElementById(id);
            const icon = section.previousElementSibling.querySelector('i');
            section.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Mobile filter toggle
        const mobileFilterToggle = document.getElementById('mobile-filter-toggle');
        const aside = document.querySelector('aside');
        mobileFilterToggle.addEventListener('click', () => {
            aside.classList.toggle('translate-x-full');
            aside.classList.toggle('fixed');
            aside.classList.toggle('inset-y-0');
            aside.classList.toggle('right-0');
            aside.classList.toggle('w-3/4');
            aside.classList.toggle('bg-white');
            aside.classList.toggle('shadow-xl');
            aside.classList.toggle('z-50');
        });

        // Price Range Filter
        const minPrice = document.getElementById('min-price');
        const maxPrice = document.getElementById('max-price');
        const minPriceValue = document.getElementById('min-price-value');
        const maxPriceValue = document.getElementById('max-price-value');
        const currentMinPrice = document.getElementById('current-min-price');
        const currentMaxPrice = document.getElementById('current-max-price');
        let debounceTimer;

        // Update price display
        function updatePriceDisplay() {
            const minVal = parseInt(minPrice.value);
            const maxVal = parseInt(maxPrice.value);
            if (minVal > maxVal - 50) {
                minPrice.value = maxVal - 50;
            }
            minPriceValue.textContent = minPrice.value;
            maxPriceValue.textContent = maxPrice.value;
            currentMinPrice.textContent = minPrice.value;
            currentMaxPrice.textContent = maxPrice.value;
        }

        // Handle price range changes
        [minPrice, maxPrice].forEach(input => {
            input.addEventListener('input', updatePriceDisplay);
            input.addEventListener('change', () => {
                showLoadingSpinner();
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    updateFilters(minPrice.value, maxPrice.value);
                }, 500);
            });
        });

        // Search Filter
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter' || e.target.value.length === 0) {
                    showLoadingSpinner();
                    updateFilters();
                }
            });
        }

        // Rating Filter
        document.querySelectorAll('input[name="ratings[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                showLoadingSpinner();
                updateFilters();
            });
        });

        function updateFilters(minPriceVal = null, maxPriceVal = null) {
            const url = new URL(window.location.href);
            const params = new URLSearchParams();

            // Price
            if (minPriceVal !== null) params.set('min_price', minPriceVal);
            if (maxPriceVal !== null) params.set('max_price', maxPriceVal);

            // Search
            if (searchInput) {
                const searchValue = searchInput.value.trim();
                if (searchValue) {
                    params.set('search', searchValue);
                }
            }

            // Ratings
            const ratings = Array.from(document.querySelectorAll('input[name="ratings[]"]:checked')).map(cb => cb.value);
            ratings.forEach(rating => params.append('ratings[]', rating));

            params.delete('page');
            window.location.href = `${url.pathname}?${params.toString()}`;
        }

        // Reset filters
        function resetFilters() {
            showLoadingSpinner();
            window.location.href = "{{ route('products.index') }}";
        }

        // View toggle
        function toggleView(type) {
            const container = document.getElementById('product-container');
            if (type === 'grid') {
                container.classList.remove('grid-cols-1', 'sm:grid-cols-1');
                container.classList.add('sm:grid-cols-2', 'lg:grid-cols-3');
            } else {
                container.classList.remove('sm:grid-cols-2', 'lg:grid-cols-3');
                container.classList.add('grid-cols-1', 'sm:grid-cols-1');
            }
        }

        // Sorting
        function updateUrlParam(key, value) {
            showLoadingSpinner();
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);
            if (value === 'latest') {
                params.delete(key);
            } else {
                params.set(key, value);
            }
            params.delete('page');
            window.location.href = `${url.pathname}?${params.toString()}`;
        }

        // Loading spinner
        function showLoadingSpinner() {
            const spinner = document.getElementById('loading-spinner');
            spinner.classList.remove('hidden');
            setTimeout(() => {
                spinner.classList.add('hidden');
            }, 2000); // Adjust based on actual loading time
        }

        // Lazy load placeholder
        document.querySelectorAll('.lazy-load').forEach(img => {
            img.addEventListener('load', () => {
                img.classList.remove('bg-gray-200', 'animate-shimmer');
            });
        });
    </script>

    <style>
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Range Slider Styling */
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: #4f46e5;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
        }

        input[type="range"]::-moz-range-thumb {
            width: 16px;
            height: 16px;
            background: #4f46e5;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
        }

        /* Lazy Load Placeholder */
        .lazy-load:not([src]) {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        /* Backdrop Blur for Glassmorphism */
        .backdrop-blur-md {
            backdrop-filter: blur(8px);
        }
    </style>

    <x-footer />
</x-app-layout>
