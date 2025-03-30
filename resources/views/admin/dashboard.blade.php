<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">

        <x-admin-sidebar />


        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">
                <!-- Products Card -->
                <div
                    class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-2xl cursor-pointer hover:shadow-blue-300 hover:transform hover:scale-105 transition duration-300">
                    <div class="p-5 flex items-start justify-between">
                        <div>
                            <span class="text-gray-500 text-sm font-medium">Total Products</span>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalProducts }}</h3>
                            <div class="flex items-center mt-3">
                                @if ($productsPercentageChange >= 0)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-up-arrow-alt mr-1'></i>
                                        {{ round($productsPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-down-arrow-alt mr-1'></i>
                                        {{ round(abs($productsPercentageChange), 0) }}%
                                    </span>
                                @endif
                                <span class="text-gray-500 text-xs ml-2">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class='bx bx-package text-2xl'></i>
                        </div>
                    </div>
                    <div class="h-1 bg-blue-200 w-full">
                        <div class="h-1 bg-blue-500" style="width: {{ min($productsPercentageChange + 50, 100) }}%">
                        </div>
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
                                @if ($ordersPercentageChange >= 0)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-up-arrow-alt mr-1'></i> {{ round($ordersPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-down-arrow-alt mr-1'></i>
                                        {{ round(abs($ordersPercentageChange), 0) }}%
                                    </span>
                                @endif
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
                                @if ($usersPercentageChange >= 0)
                                    <span
                                        class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-up-arrow-alt mr-1'></i> {{ round($usersPercentageChange, 0) }}%
                                    </span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <i class='bx bx-down-arrow-alt mr-1'></i>
                                        {{ round(abs($usersPercentageChange), 0) }}%
                                    </span>
                                @endif
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
                            <div id="orders-container">
                                @include('admin.partials.orders_table', ['recentOrders' => $recentOrders])
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800">Performance Metrics</h3>
                        <span class="text-xs text-gray-500">Updated just now</span>
                    </div>
                    <div class="p-2 grid grid-cols-2 gap-6 mt-6">
                        <!-- Avg Order Value Card -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-blue-200 inline-flex items-center justify-center mb-3 w-10 h-10">
                                        <i class='bx bx-dollar-circle text-xl text-blue-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Avg. Order
                                    </p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">
                                        ${{ number_format($averageOrderValue, 2) }}</p>
                                </div>
                                <div class="text-blue-400 opacity-20 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $avgOrderPercentageChange >= 0 ? 'trending-up' : 'trending-down' }} text-3xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                    {{ $avgOrderPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($avgOrderPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- Conversion Rate Card -->
                        <div
                            class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-green-200 inline-flex items-center justify-center mb-3 w-10 h-10">
                                        <i class='bx bx-transfer text-xl text-green-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Conversion
                                    </p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">
                                        {{ number_format($conversionRate, 1) }}%</p>
                                </div>
                                <div class="text-green-400 opacity-20 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $conversionPercentageChange >= 0 ? 'bar-chart-alt' : 'bar-chart-square' }} text-3xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                    {{ $conversionPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($conversionPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- New Users Card -->
                        <div
                            class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-purple-200 inline-flex items-center justify-center mb-3 w-10 h-10">
                                        <i class='bx bx-user-plus text-xl text-purple-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">New Users</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $newUsersCount }}</p>
                                </div>
                                <div class="text-purple-400 opacity-20 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $newUsersPercentageChange >= 0 ? 'group' : 'user-x' }} text-3xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full flex items-center">
                                    {{ $newUsersPercentageChange >= 0 ? '↑' : '↓' }}
                                    {{ number_format(abs($newUsersPercentageChange), 1) }}%
                                </span>
                            </div>
                        </div>

                        <!-- Pending Orders Card -->
                        <div
                            class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-100 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div
                                        class="p-2 rounded-lg bg-white shadow-xs border border-yellow-200 inline-flex items-center justify-center mb-3 w-10 h-10">
                                        <i class='bx bx-time-five text-xl text-yellow-600'></i>
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Pending</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pendingOrdersCount }}</p>
                                </div>
                                <div class="text-yellow-400 opacity-20 self-start mt-1">
                                    <i
                                        class='bx bx-{{ $pendingPercentageChange >= 0 ? 'timer' : 'alarm' }} text-3xl'></i>
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full flex items-center">
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
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden overflow-y-auto transition-opacity duration-300 ease-in-out opacity-0">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="inline-block w-full max-w-3xl bg-white rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 ease-in-out scale-95">
                <!-- Modal header -->
                <div class="px-6 py-4 bg-gray-50 flex justify-between items-center border-b border-gray-200">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Order #<span id="modalOrderId"></span></h3>
                        <span id="modalOrderStatus"
                            class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                    </div>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-5 space-y-5">
                    <!-- Customer & Order Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Customer Information -->
                        <div class="space-y-3">
                            <h4 class="flex items-center text-md font-medium text-gray-800">
                                <i class='bx bx-user mr-2 text-blue-500'></i>
                                Customer Details
                            </h4>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">Name</p>
                                    <p id="modalCustomerName" class="font-medium text-gray-800"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p id="modalCustomerEmail" class="font-medium text-gray-800"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Payment Method</p>
                                    <p id="modalPaymentMethod" class="font-medium text-gray-800"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="space-y-3">
                            <h4 class="flex items-center text-md font-medium text-gray-800">
                                <i class='bx bx-receipt mr-2 text-blue-500'></i>
                                Order Summary
                            </h4>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-gray-500">Date</p>
                                    <p id="modalOrderDate" class="font-medium text-gray-800"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Shipping Method</p>
                                    <p id="modalShippingMethod" class="font-medium text-gray-800"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Total Amount</p>
                                    <p id="modalOrderTotal" class="text-lg font-bold text-blue-600"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="space-y-3">
                        <h4 class="flex items-center text-md font-medium text-gray-800">
                            <i class='bx bx-map mr-2 text-blue-500'></i>
                            Shipping Address
                        </h4>
                        <div class="p-3 bg-gray-50 rounded-lg transition-colors duration-200 hover:bg-gray-100">
                            <p id="modalShippingAddress" class="text-gray-800 text-sm"></p>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" id="printOrderBtn"
                        class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition-colors">
                        <i class='bx bx-printer mr-2'></i> Print Receipt
                    </button>
                    <button type="button" id="closeModalBtn"
                        class="px-4 py-2 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('orderModal');
            const modalContent = modal.querySelector('div > div'); // The inner content div
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const printOrderBtn = document.getElementById('printOrderBtn');

            // Show modal with animation
            async function showModal() {
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
                }, 300);
            }

            async function fetchOrderDetails(orderId) {
                try {
                    document.getElementById('modalOrderId').textContent = 'Loading...';

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

                    if (order.error) {
                        throw new Error(order.message || order.error);
                    }

                    populateModal(order);
                    showModal();

                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message || 'Error loading order details');
                    document.getElementById('modalOrderId').textContent = 'Error';
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
                statusElement.className = 'inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium ' +
                    (status === 'completed' ? 'bg-green-100 text-green-800' :
                        status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                        status === 'cancelled' ? 'bg-red-100 text-red-800' :
                        'bg-gray-100 text-gray-800');

                // Format amounts
                document.getElementById('modalOrderTotal').textContent =
                    `$${parseFloat(order.total || 0).toFixed(2)}`;

                // Shipping information
                document.getElementById('modalShippingAddress').textContent =
                    `${order.address || ''}, ${order.city || ''}, ${order.state || ''} ${order.zip_code || ''}, ${order.country || ''}`
                    .trim();

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
                        }
                        break;
                    case 'cod':
                        paymentMethodDisplay = 'Cash on Delivery';
                        break;
                    default:
                        paymentMethodDisplay = order.payment_method || 'Unknown';
                }
                document.getElementById('modalPaymentMethod').textContent = paymentMethodDisplay;
            }

            // Function to attach order detail handlers
            function attachOrderDetailHandlers() {
                document.querySelectorAll('.view-order-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const orderId = this.getAttribute('data-order-id');
                        await fetchOrderDetails(orderId);
                    });
                });
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
                        <div class="flex justify-center items-center h-40">
                            <i class="bx bx-loader-alt bx-spin text-3xl text-blue-500"></i>
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
                                <div class="p-6 text-center text-red-500">
                                    Error loading orders. Please try again.
                                </div>
                            `;
                        });
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                window.location.reload();
            });

            // Close modal handlers
            closeModal.addEventListener('click', hideModal);
            closeModalBtn.addEventListener('click', hideModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    hideModal();
                }
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    hideModal();
                }
            });

            // Print order handler
            printOrderBtn.addEventListener('click', () => {
                const statusElement = document.getElementById('modalOrderStatus');
                const statusColor = statusElement.className.includes('bg-green-100') ? '#D1FAE5' :
                    statusElement.className.includes('bg-yellow-100') ? '#FEF3C7' :
                    statusElement.className.includes('bg-red-100') ? '#FEE2E2' : '#F3F4F6';
                const statusTextColor = statusElement.className.includes('text-green-800') ? '#065F46' :
                    statusElement.className.includes('text-yellow-800') ? '#92400E' :
                    statusElement.className.includes('text-red-800') ? '#991B1B' : '#374151';

                const printContent = `
                    <html>
                        <head>
                            <title>Order #${document.getElementById('modalOrderId').textContent}</title>
                            <style>
                                @import url('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css');
                                body { font-family: 'Inter', Arial, sans-serif; margin: 0; padding: 20px; color: #1f2937; }
                                .receipt-container { max-width: 600px; margin: 0 auto; }
                                .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e5e7eb; }
                                .order-title { font-size: 20px; font-weight: 600; color: #111827; }
                                .status-badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 500; margin-top: 4px; }
                                .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
                                .section { margin-bottom: 20px; }
                                .section-title { display: flex; align-items: center; font-size: 16px; font-weight: 500; color: #111827; margin-bottom: 12px; }
                                .section-content { background: #f9fafb; padding: 16px; border-radius: 8px; }
                                .info-item { margin-bottom: 8px; }
                                .info-label { font-size: 12px; color: #6b7280; margin-bottom: 2px; }
                                .info-value { font-size: 14px; font-weight: 500; color: #111827; }
                                .total-amount { font-size: 18px; font-weight: 600; color: #2563eb; }
                                .shipping-address { background: #f9fafb; padding: 16px; border-radius: 8px; font-size: 14px; line-height: 1.5; }
                                .footer { margin-top: 24px; padding-top: 16px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #6b7280; text-align: center; }
                                .icon { margin-right: 8px; color: #3b82f6; }
                            </style>
                        </head>
                        <body>
                            <div class="receipt-container">
                                <div class="header">
                                    <h1 class="order-title">Order #${document.getElementById('modalOrderId').textContent}</h1>
                                    <span class="status-badge" style="background: ${statusColor}; color: ${statusTextColor}">
                                        ${document.getElementById('modalOrderStatus').textContent}
                                    </span>
                                </div>

                                <div class="grid">
                                    <!-- Customer Information -->
                                    <div class="section">
                                        <h3 class="section-title"><i class='bx bx-user icon'></i>Customer Details</h3>
                                        <div class="section-content">
                                            <div class="info-item">
                                                <div class="info-label">Name</div>
                                                <div class="info-value">${document.getElementById('modalCustomerName').textContent}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Email</div>
                                                <div class="info-value">${document.getElementById('modalCustomerEmail').textContent}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Payment Method</div>
                                                <div class="info-value">${document.getElementById('modalPaymentMethod').textContent}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Order Summary -->
                                    <div class="section">
                                        <h3 class="section-title"><i class='bx bx-receipt icon'></i>Order Summary</h3>
                                        <div class="section-content">
                                            <div class="info-item">
                                                <div class="info-label">Date</div>
                                                <div class="info-value">${document.getElementById('modalOrderDate').textContent}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Shipping Method</div>
                                                <div class="info-value">${document.getElementById('modalShippingMethod').textContent}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">Total Amount</div>
                                                <div class="info-value total-amount">${document.getElementById('modalOrderTotal').textContent}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Information -->
                                <div class="section">
                                    <h3 class="section-title"><i class='bx bx-map icon'></i>Shipping Address</h3>
                                    <div class="shipping-address">
                                        ${document.getElementById('modalShippingAddress').textContent}
                                    </div>
                                </div>

                                <div class="footer">
                                    <p>Printed on ${new Date().toLocaleString()}</p>
                                </div>
                            </div>
                        </body>
                    </html>
                `;

                const printWindow = window.open('', '_blank');
                printWindow.document.write(printContent);
                printWindow.document.close();

                // Wait for content to load before printing
                printWindow.onload = function() {
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.close();
                    }, 200);
                };
            });

            // Initial attachment of event handlers
            attachOrderDetailHandlers();
        });
    </script>
</x-app-layout>
