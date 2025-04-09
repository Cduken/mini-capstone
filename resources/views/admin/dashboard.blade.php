<x-app-layout>
    <div class="flex min-h-screen bg-gradient-to-br from-gray-900 via-indigo-900 to-black text-white">

        <x-admin-sidebar />

        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1
                    class="text-2xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-purple-500 drop-shadow-md">
                    Dashboard Overview
                </h1>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <!-- Products Card -->
                <div
                    class="relative bg-gradient-to-br from-cyan-500/20 to-blue-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-cyan-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-cyan-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex items-start justify-between z-10">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class='bx bx-package text-xl text-cyan-400 glow'></i>
                                <span class="text-xs font-semibold text-cyan-200 tracking-wider">TOTAL PRODUCTS</span>
                            </div>
                            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ $totalProducts }}</h3>
                            <div class="flex items-center mt-2 space-x-2">
                                @if ($productsPercentageChange >= 0)
                                    <span
                                        class="bg-cyan-500/20 text-cyan-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-up-arrow-alt text-xs mr-1'></i>
                                        {{ round($productsPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-down-arrow-alt text-xs mr-1'></i>
                                        {{ round(abs($productsPercentageChange), 0) }}%
                                    </span>
                                @endif
                                <span class="text-[10px] text-gray-300">vs last month</span>
                            </div>
                        </div>
                        <div class="p-2 rounded-full bg-cyan-600/20 text-cyan-300 border border-cyan-500/50 glow">
                            <i class='bx bx-package text-2xl'></i>
                        </div>
                    </div>
                    <div class="relative h-1 mt-3 bg-cyan-900/50 rounded-full overflow-hidden">
                        <div class="absolute h-full bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full transition-all duration-700 ease-out glow"
                            style="width: {{ min($productsPercentageChange + 50, 100) }}%"></div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div
                    class="relative bg-gradient-to-br from-emerald-500/20 to-green-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-emerald-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex items-start justify-between z-10">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class='bx bx-cart-alt text-xl text-emerald-400 glow'></i>
                                <span class="text-xs font-semibold text-emerald-200 tracking-wider">TOTAL ORDERS</span>
                            </div>
                            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ $totalOrders }}</h3>
                            <div class="flex items-center mt-2 space-x-2">
                                @if ($ordersPercentageChange >= 0)
                                    <span
                                        class="bg-emerald-500/20 text-emerald-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-up-arrow-alt text-xs mr-1'></i>
                                        {{ round($ordersPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-down-arrow-alt text-xs mr-1'></i>
                                        {{ round(abs($ordersPercentageChange), 0) }}%
                                    </span>
                                @endif
                                <span class="text-[10px] text-gray-300">vs last month</span>
                            </div>
                        </div>
                        <div
                            class="p-2 rounded-full bg-emerald-600/20 text-emerald-300 border border-emerald-500/50 glow">
                            <i class='bx bx-cart-alt text-2xl'></i>
                        </div>
                    </div>
                    <div class="relative h-1 mt-3 bg-emerald-900/50 rounded-full overflow-hidden">
                        <div class="absolute h-full bg-gradient-to-r from-emerald-400 to-green-600 rounded-full transition-all duration-700 ease-out glow"
                            style="width: 85%"></div>
                    </div>
                </div>

                <!-- Users Card -->
                <div
                    class="relative bg-gradient-to-br from-purple-500/20 to-indigo-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-purple-500/30 p-4 transform hover:scale-105 transition-all duration-300 group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-purple-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex items-start justify-between z-10">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <i class='bx bx-user text-xl text-purple-400 glow'></i>
                                <span class="text-xs font-semibold text-purple-200 tracking-wider">TOTAL USERS</span>
                            </div>
                            <h3 class="text-2xl font-extrabold text-white drop-shadow-md">{{ $totalUsers }}</h3>
                            <div class="flex items-center mt-2 space-x-2">
                                @if ($usersPercentageChange >= 0)
                                    <span
                                        class="bg-purple-500/20 text-purple-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-up-arrow-alt text-xs mr-1'></i>
                                        {{ round($usersPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500/20 text-red-300 text-[10px] font-semibold px-2 py-0.5 rounded-full flex items-center glow-sm">
                                        <i class='bx bx-down-arrow-alt text-xs mr-1'></i>
                                        {{ round(abs($usersPercentageChange), 0) }}%
                                    </span>
                                @endif
                                <span class="text-[10px] text-gray-300">vs last month</span>
                            </div>
                        </div>
                        <div class="p-2 rounded-full bg-purple-600/20 text-purple-300 border border-purple-500/50 glow">
                            <i class='bx bx-user text-2xl'></i>
                        </div>
                    </div>
                    <div class="relative h-1 mt-3 bg-purple-900/50 rounded-full overflow-hidden">
                        <div class="absolute h-full bg-gradient-to-r from-purple-400 to-indigo-600 rounded-full transition-all duration-700 ease-out glow"
                            style="width: 60%"></div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-xl border border-indigo-500/20 overflow-hidden">
                        <div class="px-6 py-5 border-b border-indigo-500/30 flex justify-between items-center">
                            <h3 class="font-bold text-xl text-white drop-shadow-md">Recent Orders</h3>
                        </div>
                        @if ($recentOrders->isEmpty())
                            <div class="p-8 text-center">
                                <i class='bx bx-package text-5xl text-indigo-400/50 mb-4'></i>
                                <p class="text-gray-300">No recent orders found</p>
                            </div>
                        @else
                            <div id="orders-container">
                                @include('admin.partials.orders_table', ['recentOrders' => $recentOrders])
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div
                    class="bg-gradient-to-br from-gray-800/50 to-purple-900/50 backdrop-blur-xl rounded-xl shadow-xl border border-purple-500/20 overflow-hidden">
                    <div class="px-4 py-[20px] border-b border-purple-500/30 flex justify-between items-center">
                        <h3 class="font-bold text-lg text-white drop-shadow-md">Performance Metrics</h3>
                        <span class="text-[10px] text-gray-300">Updated just now</span>
                    </div>
                    <div class="p-6 grid grid-cols-2 gap-6 mt-4">
                        <!-- Avg Order Value -->
                        <div
                            class="bg-gradient-to-br from-cyan-600/20 to-blue-800/20 backdrop-blur-md rounded-lg p-4  border border-cyan-500/30 hover:shadow-xl hover:shadow-cyan-500/20 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-full bg-cyan-600/30 text-cyan-300 border border-cyan-500/50 mb-2 glow">
                                        <i class='bx bx-dollar-circle text-xl'></i>
                                    </div>
                                    <p class="text-[10px] font-semibold text-cyan-200 uppercase tracking-wider">Avg.
                                        Order</p>
                                    <p class="text-xl font-bold text-white drop-shadow-md">
                                        ${{ number_format($averageOrderValue, 1) }}</p>
                                </div>
                                <div class="text-cyan-400 opacity-30 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $avgOrderPercentageChange >= 0 ? 'trending-up' : 'trending-down' }} text-2xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span class="bg-cyan-500/20 text-cyan-300 text-[10px] px-2 py-0.5 rounded-full glow-sm">
                                    {{ $avgOrderPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($avgOrderPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- Conversion Rate -->
                        <div
                            class="bg-gradient-to-br from-emerald-600/20 to-green-800/20 backdrop-blur-md rounded-lg p-4  border border-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/20 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-full bg-emerald-600/30 text-emerald-300 border border-emerald-500/50 mb-2 glow">
                                        <i class='bx bx-transfer text-xl'></i>
                                    </div>
                                    <p class="text-[10px] font-semibold text-emerald-200 uppercase tracking-wider">
                                        Conversion</p>
                                    <p class="text-xl font-bold text-white drop-shadow-md">
                                        {{ number_format($conversionRate, 1) }}%</p>
                                </div>
                                <div class="text-emerald-400 opacity-30 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $conversionPercentageChange >= 0 ? 'bar-chart-alt' : 'bar-chart-square' }} text-2xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-emerald-500/20 text-emerald-300 text-[10px] px-2 py-0.5 rounded-full glow-sm">
                                    {{ $conversionPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($conversionPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- New Users -->
                        <div
                            class="bg-gradient-to-br from-purple-600/20 to-indigo-800/20 backdrop-blur-md rounded-lg p-4  border border-purple-500/30 hover:shadow-xl hover:shadow-purple-500/20 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-full bg-purple-600/30 text-purple-300 border border-purple-500/50 mb-2 glow">
                                        <i class='bx bx-user-plus text-xl'></i>
                                    </div>
                                    <p class="text-[10px] font-semibold text-purple-200 uppercase tracking-wider">New
                                        Users</p>
                                    <p class="text-xl font-bold text-white drop-shadow-md">{{ $newUsersCount }}</p>
                                </div>
                                <div class="text-purple-400 opacity-30 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $newUsersPercentageChange >= 0 ? 'group' : 'user-x' }} text-2xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-purple-500/20 text-purple-300 text-[10px] px-2 py-0.5 rounded-full glow-sm">
                                    {{ $newUsersPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($newUsersPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- Pending Orders -->
                        <div
                            class="bg-gradient-to-br from-yellow-600/20 to-amber-800/20 backdrop-blur-md rounded-lg p-4  border border-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/20 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-full bg-yellow-600/30 text-yellow-300 border border-yellow-500/50 mb-2 glow">
                                        <i class='bx bx-time-five text-xl'></i>
                                    </div>
                                    <p class="text-[10px] font-semibold text-yellow-200 uppercase tracking-wider">
                                        Pending</p>
                                    <p class="text-xl font-bold text-white drop-shadow-md">{{ $pendingOrdersCount }}
                                    </p>
                                </div>
                                <div class="text-yellow-400 opacity-30 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $pendingPercentageChange >= 0 ? 'timer' : 'alarm' }} text-2xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-yellow-500/20 text-yellow-300 text-[10px] px-2 py-0.5 rounded-full glow-sm">
                                    {{ $pendingPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($pendingPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Details Modal -->
    <div id="orderModal"
        class="fixed inset-0 bg-black/40 z-50 hidden overflow-y-auto backdrop-blur-sm transition-opacity duration-300 ease-in-out opacity-0">
        <div class="flex items-center justify-center min-h-screen p-4 sm:p-6">
            <div
                class="inline-block w-full max-w-3xl bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-indigo-500/20 overflow-hidden transform transition-all duration-300 ease-in-out scale-95">
                <!-- Modal Header -->
                <div class="relative px-6 py-5 border-b border-indigo-500/30">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="p-2 rounded-full bg-indigo-600/20 text-indigo-300 border border-indigo-500/50 glow animate-pulse">
                                <i class='bx bx-receipt text-xl'></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white drop-shadow-md">Order #<span
                                        id="modalOrderId"></span></h3>
                                <span id="modalOrderStatus"
                                    class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-500/20 text-indigo-300 glow-sm"></span>
                            </div>
                        </div>
                        <button id="closeModal"
                            class="text-white/80 hover:text-white transition-colors focus:outline-none">
                            <i class='bx bx-x text-2xl glow'></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">
                    <!-- Customer & Order Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Information -->
                        <div
                            class="bg-gradient-to-br from-cyan-500/20 to-blue-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-cyan-500/30 p-5 transform hover:scale-102 transition-all duration-300">
                            <div class="flex items-center space-x-3 mb-4">
                                <div
                                    class="p-2 rounded-full bg-cyan-600/30 text-cyan-300 border border-cyan-500/50 glow">
                                    <i class='bx bx-user-circle text-xl'></i>
                                </div>
                                <h4 class="text-base font-semibold text-white drop-shadow-md">Customer Details</h4>
                            </div>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center">
                                    <i class='bx bx-id-card text-cyan-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-cyan-200 tracking-wider">NAME</p>
                                        <p id="modalCustomerName" class="font-medium text-white"></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-envelope text-cyan-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-cyan-200 tracking-wider">EMAIL</p>
                                        <p id="modalCustomerEmail" class="font-medium text-white"></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-wallet text-cyan-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-cyan-200 tracking-wider">PAYMENT</p>
                                        <p id="modalPaymentMethod" class="font-medium text-white"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div
                            class="bg-gradient-to-br from-emerald-500/20 to-green-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-emerald-500/30 p-5 transform hover:scale-102 transition-all duration-300">
                            <div class="flex items-center space-x-3 mb-4">
                                <div
                                    class="p-2 rounded-full bg-emerald-600/30 text-emerald-300 border border-emerald-500/50 glow">
                                    <i class='bx bx-cart-alt text-xl'></i>
                                </div>
                                <h4 class="text-base font-semibold text-white drop-shadow-md">Order Summary</h4>
                            </div>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center">
                                    <i class='bx bx-calendar text-emerald-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-emerald-200 tracking-wider">DATE</p>
                                        <p id="modalOrderDate" class="font-medium text-white"></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-truck text-emerald-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-emerald-200 tracking-wider">SHIPPING</p>
                                        <p id="modalShippingMethod" class="font-medium text-white"></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-dollar-circle text-emerald-400 mr-3 glow'></i>
                                    <div>
                                        <p class="text-xs font-semibold text-emerald-200 tracking-wider">TOTAL</p>
                                        <p id="modalOrderTotal"
                                            class="text-lg font-bold text-emerald-300 drop-shadow-md"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div
                        class="bg-gradient-to-br from-purple-500/20 to-indigo-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-purple-500/30 p-5 transform hover:scale-102 transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div
                                class="p-2 rounded-full bg-purple-600/30 text-purple-300 border border-purple-500/50 glow">
                                <i class='bx bx-package text-xl'></i>
                            </div>
                            <h4 class="text-base font-semibold text-white drop-shadow-md">Purchased Items</h4>
                        </div>
                        <div id="modalOrderItems" class="space-y-3"></div>
                    </div>

                    <!-- Shipping Information -->
                    <div
                        class="bg-gradient-to-br from-yellow-500/20 to-amber-800/20 backdrop-blur-lg rounded-xl shadow-lg border border-yellow-500/30 p-5 transform hover:scale-102 transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div
                                class="p-2 rounded-full bg-yellow-600/30 text-yellow-300 border border-yellow-500/50 glow">
                                <i class='bx bx-map-alt text-xl'></i>
                            </div>
                            <h4 class="text-base font-semibold text-white drop-shadow-md">Shipping Address</h4>
                        </div>
                        <div class="flex items-start">
                            <i class='bx bx-location-plus text-yellow-400 mr-3 mt-1 glow'></i>
                            <p id="modalShippingAddress" class="text-white text-sm leading-relaxed flex-1"></p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-indigo-500/30 flex justify-end">
                    <button type="button" id="closeModalBtn"
                        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-indigo-600 to-blue-500 text-white hover:from-indigo-700 hover:to-blue-600 transition-all duration-200 shadow-md hover:shadow-lg glow-sm">
                        <i class='bx bx-x-circle mr-2'></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        #orderModal.show {
            opacity: 1;
        }

        #orderModal.show>div>div {
            scale: 1;
        }

        @media (max-width: 640px) {
            #orderModal .max-w-3xl {
                max-width: 95%;
            }

            #orderModal .grid {
                grid-template-columns: 1fr;
            }

            #orderModal .text-lg {
                font-size: 1.125rem;
            }

            #orderModal .text-base {
                font-size: 0.9375rem;
            }
        }

        /* Hover Effects */
        #orderModal .hover\:shadow-md:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Smooth Scroll Behavior */
        #orderModal {
            scroll-behavior: smooth;
        }

        .glow {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .glow-sm {
            filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.3));
        }

        /* Smooth Transitions */
        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        /* Glassmorphism */
        .backdrop-blur-lg {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .backdrop-blur-md {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
    <script>
        function showModal() {
            const modal = document.getElementById('orderModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }

        function hideModal() {
            const modal = document.getElementById('orderModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('orderModal');
            const modalContent = modal.querySelector('div > div');
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const printOrderBtn = document.getElementById('printOrderBtn');

            // Store original modal content
            const originalModalContent = modal.innerHTML;

            // Show modal with animation
            function showModal() {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95');
                }, 10);
            }

            function hideModal() {
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Restore original modal content when hiding
                    modal.innerHTML = originalModalContent;
                }, 300);
            }

            async function fetchOrderDetails(orderId) {
                try {
                    // Show loading indicator
                    modal.innerHTML = `
            <div class="fixed inset-0 flex items-center justify-center bg-white/50">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
            </div>
        `;
                    modal.classList.remove('hidden');

                    const response = await fetch(`/admin/orders/${orderId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Failed to load order details');
                    }

                    const order = await response.json();

                    // Debug log to check the received data
                    console.log('Order data received:', order);

                    // Restore original modal content before populating
                    modal.innerHTML = originalModalContent;
                    populateModal(order);
                    showModal();
                    attachModalEventListeners();

                } catch (error) {
                    console.error('Error fetching order details:', error);

                    // Show error message in modal
                    modal.innerHTML = `
            <div class="fixed inset-0 flex items-center justify-center bg-white/50">
                <div class="bg-white p-6 rounded-xl shadow-lg max-w-md text-center">
                    <div class="text-red-500 text-4xl mb-3">
                        <i class='bx bx-error-circle'></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Error Loading Order</h3>
                    <p class="text-gray-600 mb-4">${error.message || 'Failed to load order details'}</p>
                    <button onclick="hideModal()" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">
                        Close
                    </button>
                </div>
            </div>
        `;
                }
            }

            function populateModal(order) {
                // Basic order info
                document.getElementById('modalOrderId').textContent = order.id;
                document.getElementById('modalCustomerName').textContent = order.name || 'N/A';
                document.getElementById('modalCustomerEmail').textContent = order.email || 'N/A';
                document.getElementById('modalShippingMethod').textContent = order.shipping_method ||
                    'Standard Shipping';

                // Format order date
                const orderDate = order.created_at ? new Date(order.created_at) : new Date();
                document.getElementById('modalOrderDate').textContent = orderDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Set status with appropriate color
                const statusElement = document.getElementById('modalOrderStatus');
                const status = order.status || 'pending';
                statusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                statusElement.className =
                    'inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-xs font-medium glow-sm ' +
                    (status === 'completed' ? 'bg-emerald-500/20 text-emerald-300' :
                        status === 'pending' ? 'bg-yellow-500/20 text-yellow-300' :
                        status === 'cancelled' ? 'bg-red-500/20 text-red-300' :
                        'bg-gray-500/20 text-gray-300');

                // Format amounts
                document.getElementById('modalOrderTotal').textContent =
                    `$${parseFloat(order.total || 0).toFixed(2)}`;

                // Shipping information
                const addressParts = [
                    order.address_line_1 || '',
                    order.address_line_2 || '',
                    order.barangay || '',
                    order.city || '',
                    order.province || '',
                    order.region || '',
                    order.zip_code ? ` ${order.zip_code}` : '',
                    order.country || ''
                ].filter(part => part.trim() !== '');
                document.getElementById('modalShippingAddress').textContent = addressParts.join(', ');

                // Payment method display
                let paymentDetails = order.payment_details || {};
                let paymentMethodDisplay = '';
                switch (order.payment_method) {
                    case 'card':
                        paymentMethodDisplay = 'Credit Card';
                        if (paymentDetails.last_four) {
                            paymentMethodDisplay += ` (•••• ${paymentDetails.last_four})`;
                        }
                        break;
                    case 'gcash':
                        paymentMethodDisplay = 'GCash';
                        if (paymentDetails.number) {
                            paymentMethodDisplay += ` (${paymentDetails.number})`;
                            if (paymentDetails.name) {
                                paymentMethodDisplay += ` - ${paymentDetails.name}`;
                            }
                        }
                        break;
                    case 'cod':
                        paymentMethodDisplay = 'Cash on Delivery';
                        break;
                    default:
                        paymentMethodDisplay = order.payment_method ?
                            order.payment_method.charAt(0).toUpperCase() + order.payment_method.slice(1) :
                            'Unknown';
                }
                document.getElementById('modalPaymentMethod').textContent = paymentMethodDisplay;

                // Populate order items
                const itemsContainer = document.getElementById('modalOrderItems');
                itemsContainer.innerHTML = '';
                if (order.products && order.products.length > 0) {
                    order.products.forEach(product => {
                        const itemElement = document.createElement('div');
                        itemElement.className =
                            'flex items-start p-2 rounded-lg bg-purple-600/10 hover:bg-purple-600/20 transition-all duration-200';
                        itemElement.innerHTML = `
                <div class="flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden border border-purple-500/30 glow-sm">
                    <img src="${product.image}" alt="${product.title}" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-300">
                </div>
                <div class="ml-4 flex-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <h5 class="text-sm font-semibold text-white hover:text-purple-300 transition-colors duration-200">
                                ${product.title}
                            </h5>
                            <div class="mt-1 flex flex-wrap gap-2">
                                <p class="text-xs text-purple-200 flex items-center">
                                    <i class='bx bx-cube mr-1 glow'></i> Qty: ${product.quantity}
                                </p>
                                <p class="text-xs text-purple-200 flex items-center">
                                    $${parseFloat(product.price).toFixed(2)} each
                                </p>
                            </div>
                        </div>
                        <p class="ml-4 text-base font-semibold text-purple-300 drop-shadow-md">
                            $${parseFloat(product.total).toFixed(2)}
                        </p>
                    </div>
                </div>
            `;
                        itemsContainer.appendChild(itemElement);
                    });
                } else {
                    itemsContainer.innerHTML = '<p class="text-purple-200">No items found for this order.</p>';
                }
            }

            // Function to attach order detail handlers
            function attachOrderDetailHandlers() {
                document.querySelectorAll('.view-order-btn').forEach(button => {
                    button.addEventListener('click', async function(e) {
                        e.preventDefault();
                        const orderId = this.getAttribute('data-order-id');
                        await fetchOrderDetails(orderId);
                    });
                });
            }

            // Function to attach modal event listeners
            function attachModalEventListeners() {
                const closeModal = document.getElementById('closeModal');
                const closeModalBtn = document.getElementById('closeModalBtn');


                if (closeModal) {
                    closeModal.addEventListener('click', hideModal);
                }
                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', hideModal);
                }

            }


            // Handle pagination links
            document.addEventListener('click', function(e) {
                const paginationLink = e.target.closest('.pagination-link');
                if (paginationLink) {
                    e.preventDefault();
                    const url = paginationLink.getAttribute('href');

                    // Show loading indicator
                    const container = document.getElementById('orders-container');
                    container.innerHTML = `
                        <div class="flex justify-center items-center h-64">
                            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                        </div>
                    `;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            attachOrderDetailHandlers();
                            window.history.pushState(null, null, url);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            container.innerHTML = `
                                <div class="p-4 bg-red-50 text-red-600 rounded-lg mb-4">
                                    <div class="flex items-center">
                                        <i class='bx bx-error-circle text-xl mr-2'></i>
                                        <span>Error loading orders. Please try again.</span>
                                    </div>
                                </div>
                            `;
                        });
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                window.location.reload();
            });

            // Initial attachment of event listeners
            attachOrderDetailHandlers();
            attachModalEventListeners();

            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hideModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    hideModal();
                }
            });
        });
    </script>
</x-app-layout>
