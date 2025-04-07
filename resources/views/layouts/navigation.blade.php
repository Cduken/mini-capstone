<nav x-data="{ open: false, dropdownOpen: false }"
    class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50 backdrop-blur-sm bg-opacity-90">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <x-application-logo class="block h-9 w-auto text-white transition-transform group-hover:scale-105" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <!-- Navigation Links -->
                <div class="flex space-x-1">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="group">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="group">
                        {{ __('Products') }}
                    </x-nav-link>

                    @if (
                        !request()->routeIs('products.index') &&
                            !request()->routeIs('cart.index') &&
                            !request()->routeIs('products.show') &&
                            !request()->routeIs('profile.edit'))
                        <x-nav-link href="#about" :active="request()->is('#about')" class="group">
                            {{ __('About') }}
                        </x-nav-link>
                        <x-nav-link href="#contact" :active="request()->is('#contact')" class="group">
                            {{ __('Contact') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::check() && Auth::user()->userType === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="group">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')" class="group">
                            {{ __('Product List') }}
                        </x-nav-link>
                    @endif
                </div>

                <!-- Divider -->
                <div class="h-6 w-px bg-gray-700 mx-4"></div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        @if (Auth::user()->userType !== 'admin')
                            <a href="{{ route('cart.index') }}"
                                class="relative p-1 text-gray-300 hover:text-white transition-colors">
                                <i class='bx bx-cart text-2xl'></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-white text-gray-900 text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">{{ App\Models\Cart::where('user_id', Auth::id())->count() }}</span>
                            </a>
                        @endif

                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center focus:outline-none group">
                                <!-- Replace the initial letter with the avatar -->
                                <div
                                    class="w-9 h-9 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-white font-medium group-hover:bg-gray-700 transition-colors">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->name }}"
                                            class="w-full h-full rounded-full object-cover">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    @endif
                                </div>
                                <svg class="w-4 h-4 ml-1 text-gray-400 transition-transform duration-200"
                                    :class="{ 'rotate-180': dropdownOpen }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 bg-gray-800 rounded-lg shadow-xl py-1 z-50 border border-gray-700">
                                <div class="px-4 py-2 border-b border-gray-700">
                                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="flex items-center px-4 py-2 text-[#E0DBD1] hover:bg-gray-700 hover:text-white">
                                    <i class='bx bx-user mr-3 text-gray-400'></i> {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('purchases.index')"
                                    class="flex items-center px-4 py-2 text-[#E0DBD1] hover:bg-gray-700 hover:text-white">
                                    <i class='bx bx-notepad mr-3 text-gray-400'></i> {{ __('My Purchase') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center px-4 py-2 text-[#E0DBD1] hover:bg-gray-700 hover:text-white">
                                        <i class='bx bx-log-out mr-3 text-gray-400'></i> {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex space-x-3">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-light text-gray-300 hover:text-white transition-colors">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 bg-white text-gray-900 text-sm font-medium rounded-sm hover:bg-opacity-90 transition-colors">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="p-2 text-gray-300 hover:text-white focus:outline-none">
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
    <div x-show="open" @click.away="open = false" x-cloak class="md:hidden bg-gray-900 border-t border-gray-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                <i class='bx bx-home mr-3 text-gray-400'></i> {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')"
                class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                <i class='bx bx-package mr-3 text-gray-400'></i> {{ __('Products') }}
            </x-responsive-nav-link>

            @if (!request()->routeIs('products.index') && !request()->routeIs('cart.index') && !request()->routeIs('profile.edit'))
                <x-responsive-nav-link href="#about" :active="request()->is('#about')"
                    class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                    <i class='bx bx-info-circle mr-3 text-gray-400'></i> {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#contact" :active="request()->is('#contact')"
                    class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                    <i class='bx bx-envelope mr-3 text-gray-400'></i> {{ __('Contact') }}
                </x-responsive-nav-link>
            @endif

            @if (Auth::check() && Auth::user()->userType === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                    class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                    <i class='bx bx-dashboard mr-3 text-gray-400'></i> {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')"
                    class="block pl-3 pr-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                    <i class='bx bx-list-ul mr-3 text-gray-400'></i> {{ __('Product List') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Menu -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-800 px-4">
                <div class="flex items-center px-2">
                    <div class="flex-shrink-0">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-white font-medium overflow-hidden">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                    @if (Auth::user()->userType !== 'admin')
                        <a href="{{ route('cart.index') }}" class="ml-auto text-gray-400 hover:text-white relative">
                            <i class='bx bx-cart text-2xl'></i>
                            @auth
                                <span
                                    class="absolute -top-1 -right-1 bg-white text-gray-900 text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">
                                    {{ App\Models\Cart::where('user_id', Auth::id())->count() }}
                                </span>
                            @endauth
                        </a>
                    @endif
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="block pl-3 pr-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md">
                        <i class='bx bx-user mr-3 text-gray-400'></i> {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block pl-3 pr-4 py-2 text-red-400 hover:text-red-300 hover:bg-gray-800 rounded-md">
                            <i class='bx bx-log-out mr-3'></i> {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="py-4 px-4 border-t border-gray-800">
                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                        class="block w-full px-4 py-3 text-center text-white border border-gray-700 rounded-md hover:bg-gray-800 transition-colors">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="block w-full px-4 py-3 text-center text-gray-900 bg-white rounded-md hover:bg-opacity-90 transition-colors">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
