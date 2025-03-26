<!-- filepath: resources/views/components/admin-sidebar.blade.php -->
<div x-data="{ open: true }" class="flex">
    <!-- Sidebar Overlay (for mobile) -->
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden" x-transition>
    </div>

    <!-- Sidebar -->
    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed lg:relative z-30 w-64 min-h-screen bg-gradient-to-b from-gray-800 to-gray-900 text-white p-4 space-y-6 shadow-xl flex flex-col transition-all duration-300"
        :class="{ '-translate-x-full lg:translate-x-0': !open }">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between border-b border-gray-700 pb-4">
            <div class="flex items-center space-x-3">
                <i class='bx bxs-dashboard text-2xl text-blue-400'></i>
                <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-blue-300 bg-clip-text text-transparent">
                    Admin Panel</h3>
            </div>
            <button @click="open = false" class="lg:hidden p-1 rounded-full hover:bg-gray-700">
                <i class='bx bx-x text-2xl'></i>
            </button>
        </div>

        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700/50 transition-all {{ request()->routeIs('home') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class='bx bxs-home mr-3 text-xl'></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700/50 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class='bx bxs-dashboard mr-3 text-xl'></i>
                        <span>Dashboard</span>
                        <span class="ml-auto px-2 py-1 text-xs rounded-full bg-blue-500/20 text-blue-300">New</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700/50 transition-all {{ request()->routeIs('admin.products.index') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class='bx bx-package mr-3 text-xl'></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-700/50 transition-all {{ request()->routeIs('admin.users') ? 'bg-gray-700 text-blue-300' : '' }}">
                        <i class='bx bx-user mr-3 text-xl'></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="border-t border-gray-700 my-4"></div>

            <!-- Additional Menu Items -->
            <ul class="space-y-1">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center p-3 rounded-lg hover:bg-gray-700/50 transition-all">
                            <i class='bx bx-log-out mr-3 text-xl'></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="pt-4 border-t border-gray-700">
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name=Admin&background=1e40af&color=fff" alt="Admin"
                    class="w-8 h-8 rounded-full">
                <div>
                    <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Button (for mobile and desktop) -->
    <button @click="open = !open" class="fixed bottom-4 left-4 z-20 p-3 bg-gray-800 rounded-full shadow-lg"
        x-transition>
        <i class='bx bx-menu text-xl text-white' x-show="!open"></i>
        <i class='bx bx-x text-xl text-white' x-show="open"></i>
    </button>
</div>
