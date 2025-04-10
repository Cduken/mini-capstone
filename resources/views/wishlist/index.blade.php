<x-app-layout>
    <div class="py-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-2 rounded-full bg-pink-100">
                        <i class='bx bx-heart text-2xl text-pink-600'></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Wishlist</h1>
                        <p class="mt-1 text-sm text-gray-600">{{ $wishlistItems->count() }} items saved</p>
                    </div>
                </div>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class='bx bx-arrow-back mr-2'></i> Continue Shopping
                </a>
            </div>

            <!-- Wishlist Content -->
            @if ($wishlistItems->isEmpty())
                <!-- Empty state -->
                <div
                    class="text-center bg-white rounded-xl shadow-sm p-12 border border-gray-100 transform hover:scale-[1.01] transition-transform duration-200">
                    <div
                        class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gradient-to-br from-pink-50 to-purple-50 mb-4">
                        <i class='bx bx-heart text-4xl text-pink-500'></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Your wishlist is empty</h3>
                    <p class="text-gray-500 mb-6">Save your favorite items here!</p>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all duration-200 text-sm">
                        <i class='bx bx-store mr-2'></i> Explore Products
                    </a>
                </div>
            @else
                <!-- Wishlist Carousel -->
                <div class="relative group">
                    <button onclick="scrollWishlist(-1)"
                        class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-200 opacity-0 group-hover:opacity-100">
                        <i class='bx bx-chevron-left text-xl text-gray-700'></i>
                    </button>

                    <div id="wishlist-carousel" class="overflow-hidden">
                        <div
                            class="flex space-x-4 pb-4 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide">
                            @foreach ($wishlistItems as $item)
                                <div class="flex-shrink-0 w-60 sm:w-64 snap-start">
                                    <div
                                        class="relative bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                                        <!-- Remove Button -->
                                        <form action="{{ route('wishlist.remove', $item->product->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="absolute top-2 right-2 z-10 p-1 bg-white rounded-full shadow-sm hover:bg-gray-100 transition-all duration-200">
                                                <i class='bx bx-x text-lg text-gray-600'></i>
                                            </button>
                                        </form>

                                        <!-- Product Image -->
                                        <a href="{{ route('products.show', $item->product->id) }}"
                                            class="block h-40 sm:h-48 bg-gray-100 overflow-hidden rounded-t-lg">
                                            <img src="{{ asset($item->product->image) }}"
                                                alt="{{ $item->product->title }}"
                                                class="w-full h-full object-contain transition-transform duration-300 hover:scale-105">
                                        </a>

                                        <!-- Product Details -->
                                        <div class="p-3 sm:p-4">
                                            <a href="{{ route('products.show', $item->product->id) }}"
                                                class="text-base sm:text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors duration-200 line-clamp-1">
                                                {{ Str::limit($item->product->title, 40) }}
                                            </a>
                                            <div class="flex items-center justify-between mt-2">
                                                <span
                                                    class="text-base sm:text-lg font-bold text-gray-900">${{ number_format($item->product->price, 2) }}</span>
                                                <span
                                                    class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">In
                                                    Stock</span>
                                            </div>
                                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST"
                                                class="mt-3">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 text-sm flex items-center justify-center">
                                                    <i class='bx bx-cart-alt mr-2'></i> Add to Cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button onclick="scrollWishlist(1)"
                        class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-200 opacity-0 group-hover:opacity-100">
                        <i class='bx bx-chevron-right text-xl text-gray-700'></i>
                    </button>
                </div>

                <!-- Recommended Products Section -->
                @if ($recommendedProducts->isNotEmpty())
                    <div class="mt-12">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-star mr-2 text-yellow-400'></i> You Might Also Like
                        </h3>

                        <div class="relative group">
                            <button onclick="scrollRecommended(-1)"
                                class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-200 opacity-0 group-hover:opacity-100">
                                <i class='bx bx-chevron-left text-xl text-gray-700'></i>
                            </button>

                            <div id="recommended-carousel" class="overflow-hidden">
                                <div
                                    class="flex space-x-4 pb-4 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide">
                                    @foreach ($recommendedProducts as $product)
                                        <div class="flex-shrink-0 w-60 sm:w-64 snap-start">
                                            <div
                                                class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="block h-40 sm:h-48 bg-gray-100 overflow-hidden rounded-t-lg">
                                                    @if ($product->image)
                                                        <img src="{{ asset($product->image) }}"
                                                            alt="{{ $product->title }}"
                                                            class="w-full h-full object-contain transition-transform duration-300 hover:scale-105">
                                                    @else
                                                        <div
                                                            class="flex items-center justify-center h-full text-gray-400">
                                                            <i class='bx bx-image-alt text-3xl'></i>
                                                        </div>
                                                    @endif
                                                </a>
                                                <div class="p-3 sm:p-4">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="text-base font-medium text-gray-800 hover:text-blue-600 transition-colors duration-200 line-clamp-1">
                                                        {{ Str::limit($product->title, 30) }}
                                                    </a>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        ${{ number_format($product->price, 2) }}</p>
                                                    <form action="{{ route('wishlist.add', $product->id) }}"
                                                        method="POST" class="mt-2">
                                                        @csrf
                                                        <button type="submit"
                                                            class="w-full py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-md transition-all duration-200 flex items-center justify-center">
                                                            <i class='bx bx-heart mr-1'></i> Add to Wishlist
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button onclick="scrollRecommended(1)"
                                class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-100 transition-all duration-200 opacity-0 group-hover:opacity-100">
                                <i class='bx bx-chevron-right text-xl text-gray-700'></i>
                            </button>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scrolling for the page */
        html {
            scroll-behavior: smooth;
        }

        /* Fade-in animation for wishlist items */
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

        .space-x-4>div {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Delay animations for each wishlist item */
        .space-x-4>div:nth-child(1) {
            animation-delay: 0.1s;
        }

        .space-x-4>div:nth-child(2) {
            animation-delay: 0.2s;
        }

        .space-x-4>div:nth-child(3) {
            animation-delay: 0.3s;
        }

        .space-x-4>div:nth-child(4) {
            animation-delay: 0.4s;
        }

        .space-x-4>div:nth-child(5) {
            animation-delay: 0.5s;
        }
    </style>

    <script>
        function scrollWishlist(direction) {
            const carousel = document.getElementById('wishlist-carousel');
            const scrollAmount = carousel.offsetWidth * 0.9 * direction;
            carousel.querySelector('div').scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        function scrollRecommended(direction) {
            const carousel = document.getElementById('recommended-carousel');
            const scrollAmount = carousel.offsetWidth * 0.9 * direction;
            carousel.querySelector('div').scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const observeCarousel = (carouselId) => {
                const carousel = document.getElementById(carouselId);
                if (!carousel) return;
                const container = carousel.querySelector('div');
                const prevBtn = carousel.previousElementSibling;
                const nextBtn = carousel.nextElementSibling;

                const updateButtons = () => {
                    const {
                        scrollLeft,
                        scrollWidth,
                        clientWidth
                    } = container;
                    prevBtn?.classList.toggle('opacity-0', scrollLeft === 0);
                    prevBtn?.classList.toggle('pointer-events-none', scrollLeft === 0);
                    nextBtn?.classList.toggle('opacity-0', scrollLeft + clientWidth >= scrollWidth - 1);
                    nextBtn?.classList.toggle('pointer-events-none', scrollLeft + clientWidth >=
                        scrollWidth - 1);
                };

                container.addEventListener('scroll', updateButtons);
                updateButtons(); // Initial check
            };

            observeCarousel('wishlist-carousel');
            observeCarousel('recommended-carousel');
        });
    </script>
</x-app-layout>
