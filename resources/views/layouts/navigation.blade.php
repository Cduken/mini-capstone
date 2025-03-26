<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white shadow-2xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <x-application-logo class="block h-8 w-auto text-indigo-600" />
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="group">
                    {{ __('Home') }}
                    <span
                        class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('home') ? 'scale-x-100' : '' }}"></span>
                </x-nav-link>
                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="group">
                    {{ __('Products') }}
                    <span
                        class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('products.index') ? 'scale-x-100' : '' }}"></span>
                </x-nav-link>

                <!-- Conditionally show About and Contact Links if not on Products page -->
                @if (!request()->routeIs('products.index') && !request()->routeIs('cart.index') && !request()->routeIs('products.show'))
                    <x-nav-link href="#about" :active="request()->routeIs('#about')" class="group">
                        {{ __('About') }}
                        <span
                            class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('about') ? 'scale-x-100' : '' }}"></span>
                    </x-nav-link>
                    <x-nav-link href="#contact" :active="request()->routeIs('#contact')" class="group">
                        {{ __('Contact') }}
                        <span
                            class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('contact') ? 'scale-x-100' : '' }}"></span>
                    </x-nav-link>
                @endif

                @if (Auth::check() && Auth::user()->userType === 'admin')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="group">
                        {{ __('Dashboard') }}
                        <span
                            class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('admin.dashboard') ? 'scale-x-100' : '' }}"></span>
                    </x-nav-link>
                    <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')" class="group">
                        {{ __('Product List') }}
                        <span
                            class="block h-0.5 bg-indigo-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left {{ request()->routeIs('admin.products.index') ? 'scale-x-100' : '' }}"></span>
                    </x-nav-link>
                @endif
            </div>

            <!-- User Dropdown -->
            <div class="hidden md:flex items-center ml-4">
                @auth
                    <div class=" flex items-center gap-4 relative">
                        @auth
                            @if (Auth::user()->userType !== 'admin')

                                <a href="{{ route('cart.index') }}"><i class='bx bx-cart-alt text-2xl hover:text-purple-600 transition ease-in-out duration-300'></i></a>
                            @endif

                        @endauth

                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center space-x-2 focus:outline-none">
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-medium">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute top-[37px] right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <i class='bx bx-user mr-2'></i> {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <i class='bx bx-log-out mr-2'></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" :class="{ 'hidden': open, 'block': !open }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{ 'hidden': !open, 'block': open }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white shadow-lg">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block px-3 py-2 rounded-md text-base font-medium">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')"
                class="block px-3 py-2 rounded-md text-base font-medium">
                {{ __('Products') }}
            </x-responsive-nav-link>


            @if (!request()->routeIs('products.index') && !request()->routeIs('cart.index'))
                <x-responsive-nav-link href="#about" :active="request()->routeIs('#about')"
                    class="block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#contact" :active="request()->routeIs('#contact')"
                    class="block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Contact') }}
                </x-responsive-nav-link>
            @endif

            @if (Auth::check() && Auth::user()->userType === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')"
                    class="block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Products') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Menu -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-medium">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 rounded-md text-base font-medium">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-3 py-2 rounded-md text-base font-medium">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="py-3 px-4 border-t border-gray-200 bg-gray-50">
                <div class="space-y-2">
                    <a href="{{ route('login') }}"
                        class="block w-full px-4 py-2 text-center text-indigo-600 bg-white border border-indigo-600 rounded-md hover:bg-indigo-50">Login</a>
                    <a href="{{ route('register') }}"
                        class="block w-full px-4 py-2 text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Register</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
