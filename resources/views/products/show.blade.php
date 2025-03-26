<x-app-layout>
    <div class="py-12 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Product Card Container -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Breadcrumb Navigation -->
                <nav class="px-6 pt-6 flex items-center text-sm text-gray-600">
                    <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="{{ route('products.index') }}" class="hover:text-gray-900 transition-colors">Products</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $product->title }}</span>
                </nav>

                <!-- Product Content -->
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- Product Image Gallery -->
                        <div class="lg:w-1/2">
                            <div class="sticky top-6">
                                <!-- Main Image -->
                                <div class="bg-gray-100 rounded-xl overflow-hidden mb-4 flex items-center justify-center p-8">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                        class="w-full h-auto max-h-[400px] object-contain transition-transform duration-300 hover:scale-105">
                                </div>

                                <!-- Thumbnail Gallery -->
                                <div class="grid grid-cols-4 gap-3">
                                    <div class="border rounded-lg p-2 cursor-pointer hover:border-gray-400 transition">
                                        <img src="{{ asset($product->image) }}" class="w-full h-20 object-contain">
                                    </div>
                                    {{-- <div class="border rounded-lg p-2 cursor-pointer hover:border-gray-400 transition">
                                        <img src="https://via.placeholder.com/150" class="w-full h-20 object-contain">
                                    </div>
                                    <div class="border rounded-lg p-2 cursor-pointer hover:border-gray-400 transition">
                                        <img src="https://via.placeholder.com/150" class="w-full h-20 object-contain">
                                    </div>
                                    <div class="border rounded-lg p-2 cursor-pointer hover:border-gray-400 transition">
                                        <img src="https://via.placeholder.com/150" class="w-full h-20 object-contain">
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="lg:w-1/2">
                            <!-- Title and Price -->
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $product->title }}</h1>
                            <div class="flex items-center mt-4">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star-half'></i>
                                    </div>
                                    <span class="text-sm text-gray-500 ml-2">(24 reviews)</span>
                                </div>
                                <span class="mx-4 text-gray-300">|</span>
                                <span class="text-green-600 text-sm font-medium">
                                    <i class='bx bx-check-circle mr-1'></i> In Stock
                                </span>
                            </div>

                            <div class="mt-6">
                                <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                <span class="ml-2 text-sm text-gray-500 line-through">${{ number_format($product->price * 1.2, 2) }}</span>
                                <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded">20% OFF</span>
                            </div>

                            <!-- Color Options -->
                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-gray-900">Color</h3>
                                <div class="mt-2 flex space-x-2">
                                    <button class="w-10 h-10 rounded-full bg-gray-900 border-2 border-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"></button>
                                    <button class="w-10 h-10 rounded-full bg-blue-500 border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"></button>
                                    <button class="w-10 h-10 rounded-full bg-red-500 border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"></button>
                                    <button class="w-10 h-10 rounded-full bg-green-500 border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"></button>
                                </div>
                            </div>

                            <!-- Storage Options -->
                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-gray-900">Storage</h3>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <button class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50 transition">128GB</button>
                                    <button class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50 transition">256GB</button>
                                    <button class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50 transition">512GB</button>
                                    <button class="px-4 py-2 border rounded-lg bg-black text-white hover:bg-gray-800 transition">1TB</button>
                                </div>
                            </div>

                            <!-- Highlights -->
                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
                                <ul class="mt-2 space-y-2">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-500 mr-2'></i>
                                        <span class="text-sm text-gray-700">6.7" Super Retina XDR display</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-500 mr-2'></i>
                                        <span class="text-sm text-gray-700">A16 Bionic chip with 6-core CPU</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-500 mr-2'></i>
                                        <span class="text-sm text-gray-700">Advanced dual-camera system</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-500 mr-2'></i>
                                        <span class="text-sm text-gray-700">All-day battery life</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors duration-300 flex items-center justify-center">
                                        <i class='bx bx-cart mr-2'></i> Add to Cart
                                    </button>
                                </form>
                                <button class="flex-1 px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300 flex items-center justify-center">
                                    <i class='bx bx-heart mr-2'></i> Wishlist
                                </button>
                            </div>

                            <!-- Delivery Info -->
                            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class='bx bx-package text-gray-500 mr-3 text-xl'></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Free delivery</p>
                                        <p class="text-xs text-gray-500">Get it by tomorrow, {{ Carbon\Carbon::now()->addDays(1)->format('M j') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Specifications -->
                    <div class="mt-16 border-t border-gray-200 pt-12">
                        <h2 class="text-2xl font-bold text-gray-900">Specifications</h2>
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 border rounded-xl">
                                <h3 class="font-medium text-gray-900 mb-3">Display</h3>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Screen Size</span>
                                        <span>6.7 inches</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Resolution</span>
                                        <span>2796 x 1290 pixels</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Technology</span>
                                        <span>Super Retina XDR OLED</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border rounded-xl">
                                <h3 class="font-medium text-gray-900 mb-3">Hardware</h3>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Chipset</span>
                                        <span>Apple A16 Bionic</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">RAM</span>
                                        <span>6GB</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Internal Storage</span>
                                        <span>128GB/256GB/512GB/1TB</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border rounded-xl">
                                <h3 class="font-medium text-gray-900 mb-3">Camera</h3>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Main Camera</span>
                                        <span>48MP + 12MP + 12MP</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Front Camera</span>
                                        <span>12MP</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Video Recording</span>
                                        <span>4K @ 60fps</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border rounded-xl">
                                <h3 class="font-medium text-gray-900 mb-3">Battery</h3>
                                <div class="space-y-2 text-sm text-gray-700">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Capacity</span>
                                        <span>4323 mAh</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Fast Charging</span>
                                        <span>Yes, 20W</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Wireless Charging</span>
                                        <span>Yes, MagSafe</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="mt-12 border-t border-gray-200 pt-12">
                        <h2 class="text-2xl font-bold text-gray-900">Description</h2>
                        <div class="mt-6 prose prose-sm max-w-none text-gray-500">
                            <p>
                                The {{ $product->title }} features our most advanced dual-camera system with a huge leap in low-light performance. The A16 Bionic chip enables amazing photo processing. The Ceramic Shield front is tougher than any smartphone glass. And the bright, beautiful 6.7-inch Super Retina XDR display is easier to read in sunlight.
                            </p>
                            <p class="mt-4">
                                With incredible battery life, a durable design, and superfast 5G, this phone takes everything you love about iPhone to the next level. The advanced dual-camera system lets you take gorgeous photos and videos in any light. And the powerful A16 Bionic chip enables amazing performance for everything you do.
                            </p>
                            <ul class="mt-4 space-y-2">
                                <li>• 6.7-inch Super Retina XDR display</li>
                                <li>• Cinematic mode now in 4K Dolby Vision up to 30 fps</li>
                                <li>• Action mode for smooth, steady, handheld videos</li>
                                <li>• All-day battery life and up to 26 hours video playback</li>
                                <li>• Industry-leading durability features with Ceramic Shield and water resistance</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
