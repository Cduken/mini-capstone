<x-app-layout>

    <body>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>





        <div class="w-full bg-[#211C24] min-h-[91vh] md:h-[91vh]">
            <div
                class="px-4 sm:px-8 md:px-16 lg:px-32 xl:px-[166px] grid grid-cols-1 md:grid-cols-2 gap-8 items-center h-full py-8 md:py-0">
                <div class="order-2 md:order-1 text-center md:text-left">
                    <h3 class="text-[#FFFFFF] font-semibold text-xl sm:text-2xl">Pro.Beyond.</h3>
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-[80px] text-[#FFFFFF] font-thin leading-tight">
                        IPhone 16 <span class="font-bold">Pro</span>
                    </h1>
                    <p class="text-[#F5F5F5] text-base sm:text-lg mt-4">Created to change everything for the better. For
                        everyone</p>

                    <div class="mt-6 flex justify-center md:justify-start">
                        <a href="{{ route('products.index') }}">
                            <button
                                class="px-6 sm:px-8 py-2 border-2 border-white rounded-md text-white hover:bg-gray-800 transition ease-in duration-150">
                                Shop Now
                            </button>
                        </a>
                    </div>
                </div>

                <div
                    class="order-1 md:order-2 flex justify-center md:ml-[50px] lg:ml-[100px] h-[300px] sm:h-[350px] md:h-[450px]">
                    <img src="{{ asset('images/iphone 16 pro max.webp') }}" alt="iPhone 16 Pro"
                        class="h-full w-auto object-contain">
                </div>
            </div>

            <section class="min-h-screen">
                <div class="grid grid-cols-1 lg:grid-cols-2 h-auto lg:h-screen">
                    <!-- Left Column -->
                    <div class="flex flex-col">
                        <!-- Playstation Section -->
                        <div class="flex flex-col md:flex-row items-center p-6 h-auto md:h-1/2">
                            <img class="w-[250px] md:w-[350px] h-auto object-contain"
                                src="{{ asset('images/Playstation.png') }}" alt="Playstation 5">
                            <div class="flex flex-col text-center md:text-left p-4 mt-4 md:mt-0">
                                <h1 class="text-4xl md:text-[48px] text-gray-300 font-semibold">Playstation 5</h1>
                                <p class="text-gray-500 mt-2 md:mt-4">
                                    Incredibly powerful CPUs, GPUs, and an SSD with integrated I/O will redefine your
                                    PlayStation experience.
                                </p>
                            </div>
                        </div>

                        <!-- Bottom Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 h-auto md:h-1/2">
                            <!-- AirPods Section -->
                            <div class="flex flex-col sm:flex-row items-center p-6 gap-4 bg-white">
                                <div class="w-[120px] sm:w-[150px] h-[180px] sm:h-[250px]">
                                    <img class="w-full h-full object-contain" src="{{ asset('images/Headset.png') }}"
                                        alt="AirPods Max">
                                </div>
                                <div class="flex flex-col text-center sm:text-left">
                                    <h1 class="text-3xl mb-2 sm:text-[40px]">Apple</h1>
                                    <h1 class="text-3xl mb-2 sm:text-[40px]">AirPods</h1>
                                    <h1 class="text-3xl mb-2 sm:text-[40px] font-semibold">Max</h1>
                                    <p class="text-gray-500 mt-2">Computational audio. Listen, it's powerful</p>
                                </div>
                            </div>

                            <!-- Vision Pro Section -->
                            <div class="flex flex-col sm:flex-row items-center p-6 gap-4 bg-[#353535]">
                                <div class="w-[120px] sm:w-[150px] md:w-[200px] h-[120px] sm:h-[150px] md:h-[200px]">
                                    <img class="w-full h-full object-contain" src="{{ asset('images/image 36.png') }}"
                                        alt="Vision Pro">
                                </div>
                                <div class="flex flex-col text-center sm:text-left">
                                    <h1 class="text-3xl mb-2 sm:text-[40px] font-thin text-white">Apple</h1>
                                    <h1 class="text-3xl sm:text-[40px] font-thin text-white">Vision <span
                                            class="font-semibold">Pro</span></h1>
                                    <p class="text-gray-400 mt-2">An immersive way to experience entertainment</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Macbook Column -->
                    <div
                        class="bg-gray-300 flex flex-col md:flex-row items-center justify-center p-8 gap-8 h-auto lg:h-full">
                        <div class="flex flex-col text-center md:text-left mb-8 md:mb-0">
                            <h1 class="text-5xl md:text-[60px] font-thin">Macbook</h1>
                            <h1 class="text-5xl md:text-[60px] font-semibold">Air</h1>
                            <p class="text-gray-600 max-w-md mx-auto md:mx-0 mt-4">
                                The new 15‑inch MacBook Air makes room for more of what you love with a spacious Liquid
                                Retina display.
                            </p>
                        </div>
                        <div class="w-full max-w-[350px] md:w-[450px] h-[400px] md:h-[500px]">
                            <img class="w-full h-full object-contain" src="{{ asset('images/Macbook.png') }}"
                                alt="Macbook Air">
                        </div>
                    </div>
                </div>
            </section>

            @if ($products->count() > 0)
                <section class="px-4 sm:px-6 lg:px-8 py-12 bg-gray-50" id="products">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center relative pb-4">
                            Featured Products
                            <span
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></span>
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            @foreach ($products as $product)
                                <div
                                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group relative overflow-hidden border border-gray-100 hover:border-blue-100 flex flex-col h-full">

                                    <div class="absolute top-3 left-3 right-3 z-10 flex justify-between">
                                        <span
                                            class="px-3 py-1 text-center rounded-full text-xs font-semibold shadow-sm {{ $product->inStock ? 'bg-green-100 text-green-700' : 'bg-red-50 text-red-700' }}">
                                            {{ $product->inStock ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>

                                    <!-- Product Image -->
                                    <div class="relative h-64 w-full overflow-hidden bg-gray-50/50">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                            class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 p-6 mix-blend-multiply">

                                        <!-- Quick View Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="bg-white text-blue-600 px-6 py-2 rounded-full font-medium shadow-lg hover:bg-blue-50 transition-all transform translate-y-4 group-hover:translate-y-0 duration-300 flex items-center">
                                                <i class='bx bx-search-alt-2 mr-2'></i> Quick View
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-5 pt-3 flex flex-col flex-grow">
                                        <!-- Category - Changed to not be full width -->
                                        <div class="mb-3">
                                            <span
                                                class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full inline-block w-auto">
                                                {{ $product->category }}
                                            </span>
                                        </div>

                                        <!-- Title - Fixed height -->
                                        <h3
                                            class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors min-h-[3.5rem]">
                                            <a
                                                href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
                                        </h3>

                                        <!-- Rating - Fixed height container -->
                                        <div class="mb-4 min-h-[1.5rem]">
                                            <div class="flex items-center">
                                                <!-- Star Rating -->
                                                <div class="flex text-amber-400 text-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= floor($product->ratings_avg_rating))
                                                            <i class='bx bxs-star'></i>
                                                        @elseif($i == ceil($product->ratings_avg_rating) && $product->ratings_avg_rating - floor($product->ratings_avg_rating) > 0)
                                                            <i class='bx bxs-star-half'></i>
                                                        @else
                                                            <i class='bx bx-star'></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="ml-2 text-xs text-gray-500">
                                                    ({{ $product->ratings_count }}
                                                    {{ Str::plural('review', $product->ratings_count) }})
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Price & Admin Actions -->
                                        <div class="flex items-center justify-between mb-4">
                                            <div>
                                                <p class="text-xl font-bold text-gray-900">
                                                    ${{ number_format($product->price, 2) }}</p>
                                                @if ($product->original_price)
                                                    <p class="text-sm text-gray-500 line-through">
                                                        ${{ number_format($product->original_price, 2) }}</p>
                                                @endif
                                            </div>

                                            @auth
                                                @if (Auth::user()->userType === 'admin')
                                                    <div class="flex space-x-2">
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="p-2 text-red-500 hover:text-red-700 transition-colors hover:bg-red-50 rounded-full">
                                                                <i class='bx bx-trash text-xl'></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>

                                        <!-- Add to Cart Button - Now placed at bottom -->
                                        <div class="mt-auto">
                                            @auth
                                                @if (Auth::user()->userType !== 'admin')
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="block w-full bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black text-white text-center py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 {{ $product->inStock ? '' : 'opacity-50 cursor-not-allowed' }}"
                                                        {{ $product->inStock ? '' : 'disabled' }}>
                                                        <i class='bx bx-cart-alt mr-2'></i> Click to Buy
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="block w-full bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black text-white text-center py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                                    <i class='bx bx-cart-alt mr-2'></i> Click to Buy
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                <section class="px-4 sm:px-6 lg:px-8 py-12 bg-gray-50">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center relative pb-4">
                            No Products Available
                            <span
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></span>
                        </h2>
                    </div>
                </section>
            @endif

            <section class="px-4 sm:px-6 md:px-8 lg:px-12 xl:px-[120px] bg-gray-100 pt-8 pb-16" id="about">
                <h2 class="text-lg sm:text-xl font-bold border-b border-gray-400 pb-4 mb-8 mt-8 sm:mt-11 sm:mb-11">
                    About Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                    <!-- About Content -->
                    <div class="space-y-4 sm:space-y-6">
                        <h3 class="text-3xl sm:text-4xl font-bold text-gray-800">Who We Are</h3>
                        <p class="text-gray-600 text-base sm:text-lg">
                            We are ShopEase, your ultimate destination for the latest and greatest in technology. Our
                            mission is to provide you with high-quality products that enhance your lifestyle and keep
                            you connected to the world.
                        </p>
                        <p class="text-gray-600 text-base sm:text-lg">
                            From cutting-edge smartphones to powerful laptops and innovative gadgets, we bring you the
                            best from top brands like Apple, Samsung, and more. Our team is passionate about technology
                            and dedicated to helping you find the perfect product for your needs.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                            <div class="flex items-center space-x-2">
                                <i class='bx bx-check-shield text-2xl sm:text-3xl text-blue-600'></i>
                                <span class="text-gray-700 font-medium sm:font-semibold">Quality Assurance</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class='bx bx-headphone text-2xl sm:text-3xl text-green-600'></i>
                                <span class="text-gray-700 font-medium sm:font-semibold">24/7 Support</span>
                            </div>
                        </div>
                        <a href="#contact" class="inline-block">
                            <button
                                class="px-6 sm:px-8 py-2 sm:py-3 bg-black text-white rounded-md hover:bg-gray-800 transition duration-300 mt-4 sm:mt-6">
                                Contact Us
                            </button>
                        </a>
                    </div>

                    <!-- About Image -->
                    <div class="relative mt-8 md:mt-0">
                        <img src="{{ asset('images/6174398.jpg') }}" alt="About Us"
                            class="w-full rounded-lg shadow-xl">
                        <div
                            class="absolute -bottom-4 sm:-bottom-6 md:-bottom-8 -right-4 sm:-right-6 md:-right-8 bg-white p-3 sm:p-4 md:p-6 rounded-lg shadow-md">
                            <h4 class="text-xl sm:text-2xl font-bold text-gray-800">5+ Years</h4>
                            <p class="text-sm sm:text-base text-gray-600">of Experience</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-4 sm:px-6 lg:px-8 xl:px-32 2xl:px-40 bg-white py-10 md:py-16" id="contact">
                <div class="max-w-7xl mx-auto">
                    <h2
                        class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 md:mb-12 pb-4 border-b border-gray-200">
                        Contact Us</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                        <!-- Contact Form -->
                        <div
                            class="bg-gray-50 p-6 md:p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
                            <form action="#" method="POST" class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="name"
                                        class="block text-sm md:text-base font-medium text-gray-700">Your Name</label>
                                    <input type="text" id="name" name="name" required
                                        class="mt-1 block w-full px-4 py-2 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-sm md:text-base font-medium text-gray-700">Your Email</label>
                                    <input type="email" id="email" name="email" required
                                        class="mt-1 block w-full px-4 py-2 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                <div>
                                    <label for="message"
                                        class="block text-sm md:text-base font-medium text-gray-700">Your
                                        Message</label>
                                    <textarea id="message" name="message" rows="4" required
                                        class="mt-1 block w-full px-4 py-2 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="w-full bg-black text-white py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300 text-sm md:text-base font-medium">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Contact Information -->
                        <div class="space-y-6 md:space-y-8">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800">Contact Information</h3>
                            <div class="space-y-4 md:space-y-6">
                                <!-- Address -->
                                <div class="flex items-start space-x-3 md:space-x-4">
                                    <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                        <i class='bx bx-map text-xl md:text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-base md:text-lg font-semibold text-gray-800">Our Office</h4>
                                        <p class="text-gray-600 text-sm md:text-base">Tubigon, Bohol</p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-start space-x-3 md:space-x-4">
                                    <div class="p-2 bg-green-100 rounded-lg text-green-600">
                                        <i class='bx bx-phone text-xl md:text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-base md:text-lg font-semibold text-gray-800">Phone</h4>
                                        <p class="text-gray-600 text-sm md:text-base">+(69) 123-456-789</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start space-x-3 md:space-x-4">
                                    <div class="p-2 bg-purple-100 rounded-lg text-purple-600">
                                        <i class='bx bx-envelope text-xl md:text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-base md:text-lg font-semibold text-gray-800">Email</h4>
                                        <p class="text-gray-600 text-sm md:text-base break-all">
                                            ernestojrcabarrubias@gmail.com</p>
                                    </div>
                                </div>


                                <div class="flex items-start space-x-3 md:space-x-4">
                                    <div class="p-2 bg-orange-100 rounded-lg text-orange-600">
                                        <i class='bx bx-share-alt text-xl md:text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-base md:text-lg font-semibold text-gray-800">Follow Us</h4>
                                        <div class="flex space-x-3 md:space-x-4 mt-2">
                                            <a href="https://www.facebook.com/cdukenzxc" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-blue-600 transition">
                                                <i class='bx bxl-facebook text-2xl md:text-3xl'></i>
                                            </a>
                                            <a href="https://www.instagram.com/cdukenzxc/" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-pink-600 transition">
                                                <i class='bx bxl-instagram text-2xl md:text-3xl'></i>
                                            </a>
                                            <a href="https://discord.com/channels/@me" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-violet-500 transition">
                                                <i class='bx bxl-discord text-2xl md:text-3xl'></i>
                                            </a>
                                            <a href="https://www.linkedin.com/in/ernestojr-cabarrubias-3154342a1/"
                                                target="_blank" rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-blue-600 transition">
                                                <i class='bx bxl-linkedin text-2xl md:text-3xl'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <x-footer />
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>

</x-app-layout>
