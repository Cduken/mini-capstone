<x-app-layout>

    <body>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>





        <div class="w-full bg-[#211C24] h-[91vh]">
            <div class="pr-[120px] pl-[120px] grid grid-cols-2 gap-4 items-center h-full">
                <div class="col-span-1">
                    <h3 class="text-[#FFFFFF] font-semibold text-2xl">Pro.Beyond.</h3>
                    <h1 class="text-[80px] text-[#FFFFFF] font-thin">IPhone 14 <span
                            class="font-bold text-[80px]">Pro</span></h1>
                    <p class="text-[#F5F5F5] text-lg">Created to change everything for the better. For everyone</p>

                    <a href="{{ route('products.index') }}">
                        <button
                            class="px-8 py-2 border-2 border-white mt-4 rounded-md text-white block items-center justify-center hover:bg-gray-800 transition ease-in duration-150">Shop
                            Now</button>
                    </a>
                </div>

                <div class="ml-[100px] mt-[40px]">
                    <img src="{{ asset('images/HomeIPhoneImage.png') }}" alt="">
                </div>
            </div>

            <section class="h-[100vh]">
                <div class="grid grid-cols-2 h-screen">
                    <div class="flex items-center flex-col">
                        <div class="flex h-full items-center">
                            <img class="w-[350px] h-full" src="{{ asset('images/Playstation.png') }}" alt="">
                            <div class="flex flex-col text-left p-4 ">
                                <h1 class="text-[55px] font-semibold">Playstation 5</h1>
                                <p class="text-gray-500">Incredibly powerful CPUs, GPUs, and an SSD with integrated I/O
                                    will
                                    redefine your PlayStation experience.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 h-full">
                            <div class="flex items-center gap-8">
                                <div class="w-[150px] h-[250px]">
                                    <img class="w-full h-full" src="{{ asset('images/Headset.png') }}" alt="">
                                </div>
                                <div class="flex flex-col text-left pl-8 pr-8">
                                    <h1 class="text-[40px]">Apple</h1>
                                    <h1 class="text-[40px] mt-[-10px]">AirPods</h1>
                                    <h1 class="text-[40px] font-semibold mt-[-10px]">Max</h1>
                                    <p class="text-gray-500">Computational audio. Listen, it's powerful</p>
                                </div>
                            </div>

                            <div class="flex items-center bg-[#353535]">
                                <div class="w-[200px] h-[200px]">
                                    <img class="w-full h-full" src="{{ asset('images/image 36.png') }}" alt="">
                                </div>
                                <div class="flex flex-col text-left pl-12 pr-12">
                                    <h1 class="text-[40px] font-thin text-white">Apple</h1>
                                    <h1 class="text-[40px] mt-[-10px] font-thin text-white">Vision <span
                                            class="font-semibold">Pro</span></h1>
                                    <p class="text-gray-500">An immersive way to experience entertainment</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-300 flex items-center gap-12">
                        <div class="flex flex-col text-left p-8 ">
                            <h1 class="text-[60px] font-thin">Macbook</h1>
                            <h1 class="text-[60px] font-semibold mt-[-30px]">Air</h1>
                            <p class="text-gray-500">The new 15‑inch MacBook Air makes room for more of what you love
                                with
                                a spacious Liquid Retina display.</p>
                        </div>
                        <div class=" h-[500px] w-[450px] pb-8 pt-8">
                            <img class="h-full w-full " src="{{ asset('images/Macbook.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </section>

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
                                class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 group relative overflow-hidden border border-gray-100 hover:border-blue-100">
                                <!-- Wishlist & Stock Badge Container -->
                                <div class="absolute top-3 left-3 right-3 z-10 flex justify-between">
                                    <!-- Wishlist Button -->
                                    <button
                                        class="p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-sm hover:bg-gray-100 transition-colors group/wishlist">
                                        <i
                                            class='bx bx-heart text-xl text-gray-500 group-hover/wishlist:text-red-500 transition-colors'></i>
                                    </button>

                                    <!-- Stock Status Badge -->
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm {{ $product->inStock ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
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
                                <div class="p-5 pt-3">
                                    <!-- Category -->
                                    <span
                                        class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-3 inline-block">
                                        {{ $product->category }}
                                    </span>

                                    <!-- Title -->
                                    <h3
                                        class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition-colors">
                                        <a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
                                    </h3>

                                    <!-- Rating -->
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-amber-400 text-sm">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star-half'></i>
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500">(24 reviews)</span>
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

                                    <!-- Add to Cart Button -->
                                    <div class="mt-2">
                                        @auth
                                            @if (Auth::user()->userType !== 'admin')
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="block w-full bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black text-white text-center py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 {{ $product->inStock ? '' : 'opacity-50 cursor-not-allowed' }}"
                                                    {{ $product->inStock ? '' : 'disabled' }}>
                                                    <i class='bx bx-cart-alt mr-2'></i> Add to Cart
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="block w-full bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black text-white text-center py-3 px-4 rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                                <i class='bx bx-cart-alt mr-2'></i> Add to Cart
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="pr-[120px] pl-[120px] bg-gray-100 pt-2 pb-16" id="about">
                <h2 class="text-md mt-11 mb-11 font-bold border-b border-gray-400 pb-6">About Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <!-- About Content -->
                    <div class="space-y-6">
                        <h3 class="text-4xl font-bold text-gray-800">Who We Are</h3>
                        <p class="text-gray-600 text-lg">
                            We are ShopEase, your ultimate destination for the latest and greatest in technology. Our
                            mission
                            is to provide you with high-quality products that enhance your lifestyle and keep you
                            connected
                            to the world.
                        </p>
                        <p class="text-gray-600 text-lg">
                            From cutting-edge smartphones to powerful laptops and innovative gadgets, we bring you the
                            best
                            from top brands like Apple, Samsung, and more. Our team is passionate about technology and
                            dedicated to helping you find the perfect product for your needs.
                        </p>
                        <div class="flex space-x-6">
                            <div class="flex items-center space-x-2">
                                <i class='bx bx-check-shield text-3xl text-blue-600'></i>
                                <span class="text-gray-700 font-semibold">Quality Assurance</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class='bx bx-headphone text-3xl text-green-600'></i>
                                <span class="text-gray-700 font-semibold">24/7 Support</span>
                            </div>
                        </div>
                        <a href="#contact">
                            <button
                                class="px-8 py-3 bg-black text-white rounded-md hover:bg-gray-800 transition duration-300 mt-6">
                                Contact Us
                            </button>
                        </a>
                    </div>

                    <!-- About Image -->
                    <div class="relative">
                        <img src="{{ asset('images/6174398.jpg') }}" alt="About Us" class="rounded-lg shadow-2xl">
                        <div class="absolute -bottom-8 -right-8 bg-white p-6 rounded-lg shadow-lg">
                            <h4 class="text-2xl font-bold text-gray-800">5+ Years</h4>
                            <p class="text-gray-600">of Experience</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pr-[120px] pl-[120px] bg-white pb-10" id="contact">
                <h2 class="text-md mt-11 mb-11 font-bold border-b border-gray-400 pb-6">Contact Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
                        <form action="#" method="POST" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Your
                                    Name</label>
                                <input type="text" id="name" name="name" required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Your
                                    Email</label>
                                <input type="email" id="email" name="email" required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Your
                                    Message</label>
                                <textarea id="message" name="message" rows="5" required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-300">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <h3 class="text-2xl font-bold text-gray-800">Contact Information</h3>
                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="flex items-start space-x-4">
                                <i class='bx bx-map text-3xl text-blue-600'></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">Our Office</h4>
                                    <p class="text-gray-600">Tubigon, Bohol</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start space-x-4">
                                <i class='bx bx-phone text-3xl text-green-600'></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">Phone</h4>
                                    <p class="text-gray-600">+(69) 123-456-789</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4">
                                <i class='bx bx-envelope text-3xl text-purple-600'></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">Email</h4>
                                    <p class="text-gray-600">ernestojrcabarrubias@gmail.com</p>
                                </div>
                            </div>

                            <!-- Social Media Links -->
                            <div class="flex items-start space-x-4">
                                <i class='bx bx-share-alt text-3xl text-orange-600'></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">Follow Us</h4>
                                    <div class="flex space-x-4 mt-2">
                                        <a href="https://www.facebook.com/cdukenzxc"
                                            class="text-gray-600 hover:text-blue-600">
                                            <i class='bx bxl-facebook text-2xl'></i>
                                        </a>
                                        <a href="https://www.instagram.com/cdukenzxc/"
                                            class="text-gray-600 hover:text-pink-600">
                                            <i class='bx bxl-instagram text-2xl'></i>
                                        </a>
                                        <a href="https://discord.com/channels/@me"
                                            class="text-gray-600 hover:text-violet-500">
                                            <i class='bx bxl-discord text-2xl'></i>
                                        </a>
                                        <a href="https://www.linkedin.com/in/ernestojr-cabarrubias-3154342a1/"
                                            class="text-gray-600 hover:text-blue-600">
                                            <i class='bx bxl-linkedin text-2xl'></i>
                                        </a>
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
