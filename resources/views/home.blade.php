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
                    <p class="text-[#F5F5F5] text-base sm:text-lg mt-4">
                        ShopEase brings you the latest gadgets at unbeatable prices. Discover tech that fits your
                        lifestyle and budget.
                    </p>

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

            <section
                class="px-4 sm:px-6 md:px-8 lg:px-12 xl:px-32 py-16 md:py-24 bg-gradient-to-br from-gray-50 to-blue-50"
                id="about">
                <div class="max-w-7xl mx-auto">
                    <!-- Heading -->
                    <h2
                        class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-12 pb-4 border-b-2 border-blue-200 tracking-tight text-center">
                        About ShopEase
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <!-- About Content -->
                        <div class="space-y-6">
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-800">Who We Are</h3>
                            <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                At ShopEase, we’re your go-to destination for cutting-edge technology. Our mission is to
                                deliver high-quality products that elevate your lifestyle and keep you connected to the
                                world.
                            </p>
                            <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                From sleek smartphones to powerful laptops and innovative gadgets, we curate the best
                                from top brands like Apple, Samsung, and beyond. Our passionate team is dedicated to
                                helping you find the perfect tech for your needs.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex items-center space-x-3 group">
                                    <div
                                        class="p-3 bg-blue-100 rounded-full text-blue-600 group-hover:bg-blue-200 transition-all duration-300">
                                        <i class='bx bx-check-shield text-2xl'></i>
                                    </div>
                                    <span class="text-gray-700 font-semibold">Unmatched Quality</span>
                                </div>
                                <div class="flex items-center space-x-3 group">
                                    <div
                                        class="p-3 bg-green-100 rounded-full text-green-600 group-hover:bg-green-200 transition-all duration-300">
                                        <i class='bx bx-headphone text-2xl'></i>
                                    </div>
                                    <span class="text-gray-700 font-semibold">24/7 Support</span>
                                </div>
                            </div>
                            <a href="#contact" class="inline-block">
                                <button
                                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium transform hover:-translate-y-1">
                                    Get in Touch
                                </button>
                            </a>
                        </div>

                        <!-- About Image -->
                        <div class="relative mt-8 md:mt-0">
                            <div
                                class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                                <img src="{{ asset('images/6174398.jpg') }}" alt="About Us"
                                    class="w-full rounded-xl object-cover h-80 md:h-96">
                                <div
                                    class="absolute -bottom-6 -right-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-4 md:p-6 rounded-xl shadow-md transform hover:scale-105 transition-all duration-300">
                                    <h4 class="text-xl md:text-2xl font-bold">5+ Years</h4>
                                    <p class="text-sm md:text-base">of Excellence</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <style>
                /* Custom Animation */
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-fade-in-up {
                    animation: fadeInUp 0.6s ease-out forwards;
                }
            </style>

            <section
                class="px-4 sm:px-6 lg:px-8 xl:px-32 2xl:px-40 py-16 md:py-24 bg-gradient-to-br from-gray-50 to-blue-50"
                id="contact">
                <div class="max-w-7xl mx-auto">
                    <!-- Heading -->
                    <h2
                        class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-12 pb-4 border-b-2 border-blue-200 tracking-tight">
                        Let’s Connect
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Contact Form -->
                        <div
                            class="bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                            <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8">Send Us a Message</h3>
                            <form id="contact-form" class="space-y-6">
                                <div class="relative">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your
                                        Name</label>
                                    <input type="text" id="name" name="from_name" required
                                        class="w-full px-5 py-3 text-base bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 placeholder-gray-400">
                                </div>
                                <div class="relative">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Your
                                        Email</label>
                                    <input type="email" id="email" name="from_email" required
                                        class="w-full px-5 py-3 text-base bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 placeholder-gray-400">
                                </div>
                                <div class="relative">
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your
                                        Message</label>
                                    <textarea id="message" name="message" rows="4" required
                                        class="w-full px-5 py-3 text-base bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 placeholder-gray-400 resize-none"></textarea>
                                </div>
                                <div>
                                    <button type="submit" id="submit-btn"
                                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium flex items-center justify-center transform hover:-translate-y-1">
                                        <span id="button-text">Send Message</span>
                                        <svg id="spinner" class="hidden w-5 h-5 ml-2 animate-spin"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            <div id="success-message"
                                class="hidden mt-6 p-4 bg-green-100 text-green-800 rounded-xl font-medium animate-fade-in">
                                Message sent successfully! We’ll reach out soon.
                            </div>
                            <div id="error-message"
                                class="hidden mt-6 p-4 bg-red-100 text-red-800 rounded-xl font-medium animate-fade-in">
                                Oops! Something went wrong. Please try again.
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="space-y-8">
                            <h3 class="text-2xl md:text-3xl font-semibold text-gray-800">Reach Out</h3>
                            <div class="space-y-6">
                                <!-- Address -->
                                <div class="flex items-center space-x-4 group">
                                    <div
                                        class="p-3 bg-blue-100 rounded-full text-blue-600 group-hover:bg-blue-200 transition-all duration-300">
                                        <i class='bx bx-map text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">Our Office</h4>
                                        <p class="text-gray-600">Tubigon, Bohol</p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-center space-x-4 group">
                                    <div
                                        class="p-3 bg-green-100 rounded-full text-green-600 group-hover:bg-green-200 transition-all duration-300">
                                        <i class='bx bx-phone text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">Phone</h4>
                                        <p class="text-gray-600">+(69) 123-456-789</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-center space-x-4 group">
                                    <div
                                        class="p-3 bg-purple-100 rounded-full text-purple-600 group-hover:bg-purple-200 transition-all duration-300">
                                        <i class='bx bx-envelope text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">Email</h4>
                                        <p class="text-gray-600 break-all">ernestojrcabarrubias@gmail.com</p>
                                    </div>
                                </div>

                                <!-- Social Media -->
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                                        <i class='bx bx-share-alt text-2xl'></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">Follow Us</h4>
                                        <div class="flex space-x-4 mt-3">
                                            <a href="https://www.facebook.com/cdukenzxc" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-blue-600 transition-all duration-300 transform hover:scale-110">
                                                <i class='bx bxl-facebook text-3xl'></i>
                                            </a>
                                            <a href="https://www.instagram.com/cdukenzxc/" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-pink-600 transition-all duration-300 transform hover:scale-110">
                                                <i class='bx bxl-instagram text-3xl'></i>
                                            </a>
                                            <a href="https://discord.com/channels/@me" target="_blank"
                                                rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-violet-500 transition-all duration-300 transform hover:scale-110">
                                                <i class='bx bxl-discord text-3xl'></i>
                                            </a>
                                            <a href="https://www.linkedin.com/in/ernestojr-cabarrubias-3154342a1/"
                                                target="_blank" rel="noopener noreferrer"
                                                class="text-gray-600 hover:text-blue-600 transition-all duration-300 transform hover:scale-110">
                                                <i class='bx bxl-linkedin text-3xl'></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <style>
                /* Custom Animation */
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

                .animate-fade-in {
                    animation: fadeIn 0.5s ease-out forwards;
                }
            </style>

            <x-footer />
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        <!-- Load EmailJS SDK -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

        <script>
            // Initialize EmailJS with your public key
            emailjs.init('1k-kTv6PrhhLmY97i'); // Replace with your actual public key if different

            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();

                const submitBtn = document.getElementById('submit-btn');
                const buttonText = document.getElementById('button-text');
                const spinner = document.getElementById('spinner');
                const successMessage = document.getElementById('success-message');
                const errorMessage = document.getElementById('error-message');

                // Get form values
                const formData = {
                    from_name: document.getElementById('name').value.trim(),
                    from_email: document.getElementById('email').value.trim(),
                    message: document.getElementById('message').value.trim()
                };

                // Validate form
                if (!formData.from_name || !formData.from_email || !formData.message) {
                    errorMessage.textContent = 'Please fill in all fields';
                    errorMessage.classList.remove('hidden');
                    return;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.from_email)) {
                    errorMessage.textContent = 'Please enter a valid email address';
                    errorMessage.classList.remove('hidden');
                    return;
                }

                // Change button state
                buttonText.textContent = 'Sending...';
                spinner.classList.remove('hidden');
                submitBtn.disabled = true;

                // Hide any previous messages
                successMessage.classList.add('hidden');
                errorMessage.classList.add('hidden');

                // Send the email using EmailJS
                emailjs.send('service_kkv6sr4', 'template_s74uso9', formData)
                    .then(function(response) {
                        console.log('SUCCESS!', response.status, response.text);
                        // Show success message
                        successMessage.textContent = 'Message sent successfully! We\'ll get back to you soon.';
                        successMessage.classList.remove('hidden');
                        // Reset form
                        document.getElementById('contact-form').reset();
                    }, function(error) {
                        console.log('FAILED...', error);
                        // Show error message
                        errorMessage.textContent =
                            'There was an error sending your message. Please try again later.';
                        if (error.text.includes('quota')) {
                            errorMessage.textContent += ' (Daily email limit reached)';
                        }
                        errorMessage.classList.remove('hidden');
                    })
                    .finally(function() {
                        // Reset button state
                        buttonText.textContent = 'Send Message';
                        spinner.classList.add('hidden');
                        submitBtn.disabled = false;
                    });
            });
        </script>
    </body>

</x-app-layout>
