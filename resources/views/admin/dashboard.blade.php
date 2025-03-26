<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <!-- Products Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-blue-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Total Products</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalProducts }}</h3>
                            <div class="flex items-center mt-3">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center">
                                    <i class='bx bx-up-arrow-alt mr-1'></i> 12%
                                </span>
                                <span class="text-gray-500 text-xs ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class='bx bx-package text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-blue-200 w-full">
                        <div class="h-1 bg-blue-500" style="width: 70%"></div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-green-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Total Orders</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalOrders }}</h3>
                            <div class="flex items-center mt-3">
                                <span
                                    class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center">
                                    <i class='bx bx-up-arrow-alt mr-1'></i> 24%
                                </span>
                                <span class="text-gray-500 text-xs ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <i class='bx bx-cart-alt text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-green-200 w-full">
                        <div class="h-1 bg-green-500" style="width: 85%"></div>
                    </div>
                </div>

                <!-- Users Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-purple-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Total Users</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</h3>
                            <div class="flex items-center mt-3">
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full flex items-center">
                                    <i class='bx bx-up-arrow-alt mr-1'></i> 8%
                                </span>
                                <span class="text-gray-500 text-xs ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <i class='bx bx-user text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-purple-200 w-full">
                        <div class="h-1 bg-purple-500" style="width: 60%"></div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Orders -->
                <!-- Recent Orders -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-semibold text-gray-800">Recent Orders</h3>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                View all <i class='bx bx-chevron-right ml-1'></i>
                            </a>
                        </div>

                        @if ($recentOrders->isEmpty())
                            <div class="p-6 text-center">
                                <i class='bx bx-package text-4xl text-gray-300 mb-3'></i>
                                <p class="text-gray-500">No recent orders found</p>
                            </div>
                        @else
                            <div class="overflow-y-auto max-h-[400px]">
                                <table class="w-full" id="orders-table">
                                    <thead class="bg-gray-50 text-gray-600 text-left text-sm">
                                        <tr>
                                            <th class="py-3 px-5 font-medium">Order</th>
                                            <th class="py-3 px-5 font-medium">Customer</th>
                                            <th class="py-3 px-5 font-medium">Total</th>
                                            <th class="py-3 px-5 font-medium">Status</th>
                                            <th class="py-3 px-5 font-medium">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($recentOrders as $order)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="py-4 px-5">
                                                    <div class="font-medium text-gray-800">#{{ $order->id }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $order->created_at->format('M d, Y') }}</div>
                                                </td>
                                                <td class="py-4 px-5">
                                                    <div class="font-medium">{{ $order->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $order->email }}</div>
                                                </td>
                                                <td class="py-4 px-5 font-medium">${{ number_format($order->total, 2) }}
                                                </td>
                                                <td class="py-4 px-5">
                                                    <span
                                                        class="px-2.5 py-1 rounded-full text-xs font-medium
                                        @if ($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td class="py-4 px-5">
                                                    <a href="#">
                                                        <!-- Using the correct route name -->
                                                        <button class="text-blue-600 hover:text-blue-800">
                                                            <i class='bx bx-show text-xl'></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="px-5 py-3 border-t border-black">
                                @if ($recentOrders->hasPages())
                                    {{ $recentOrders->links('vendor.pagination.tailwind') }}
                                @endif
                            </div> --}}
                        @endif
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800">Performance Metrics</h3>
                        <span class="text-xs text-gray-500">Updated just now</span>
                    </div>
                    <div class="p-5 grid grid-cols-2 gap-4">
                        <!-- Avg Order Value Card -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-blue-200 inline-block mb-3">
                                        <i class='bx bx-dollar-circle text-xl text-blue-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Avg. Order</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">
                                        ${{ number_format($averageOrderValue, 2) }}</p>
                                    <div class="flex items-center mt-2">
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                            <i class='bx bx-trending-up mr-1'></i> 5.2%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-blue-400 opacity-20">
                                    <i class='bx bx-trending-up text-4xl'></i>
                                </div>
                            </div>
                        </div>

                        <!-- Conversion Rate Card -->
                        <div
                            class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-green-200 inline-block mb-3">
                                        <i class='bx bx-refresh text-xl text-green-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Conversion
                                    </p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">
                                        {{ number_format($conversionRate, 1) }}%</p>
                                    <div class="flex items-center mt-2">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                            <i class='bx bx-trending-up mr-1'></i> 1.8%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-green-400 opacity-20">
                                    <i class='bx bx-bar-chart-alt text-4xl'></i>
                                </div>
                            </div>
                        </div>

                        <!-- New Users Card -->
                        <div
                            class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-purple-200 inline-block mb-3">
                                        <i class='bx bx-user-plus text-xl text-purple-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">New Users</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $newUsersCount }}</p>
                                    <div class="flex items-center mt-2">
                                        <span
                                            class="bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                            <i class='bx bx-trending-up mr-1'></i> 12.4%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-purple-400 opacity-20">
                                    <i class='bx bx-group text-4xl'></i>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Orders Card -->
                        <div
                            class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-yellow-200 inline-block mb-3">
                                        <i class='bx bx-time-five text-xl text-yellow-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pending</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pendingOrdersCount }}</p>
                                    <div class="flex items-center mt-2">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                            <i class='bx bx-trending-down mr-1'></i> 3.1%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-yellow-400 opacity-20">
                                    <i class='bx bx-alarm-exclamation text-4xl'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
