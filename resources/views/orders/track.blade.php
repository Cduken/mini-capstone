<x-app-layout>
    <div class="py-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order Tracking <span
                            class="text-blue-600">#{{ $order->id }}</span></h1>
                    <p class="mt-1 text-sm text-gray-600">Real-time updates on your order's journey</p>
                </div>
                <a href="{{ route('purchases.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class='bx bx-arrow-back mr-2'></i> Back to Orders
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <!-- Order Summary -->
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Order Date</h3>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Total Amount</h3>
                            <p class="text-sm font-medium text-gray-900">${{ number_format($order->total, 2) }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Payment Method</h3>
                            <p class="text-sm font-medium text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tracking Status Card -->
                <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-package mr-2 text-blue-600'></i> Current Status
                    </h2>

                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Status Badge -->
                        <div id="statusBadge"
                            class="status-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                            {{ $currentStatus === 'Delivered'
                                ? 'bg-green-100 text-green-800'
                                : ($currentStatus === 'Shipped'
                                    ? 'bg-purple-100 text-purple-800'
                                    : ($currentStatus === 'Processing'
                                        ? 'bg-blue-100 text-blue-800'
                                        : ($currentStatus === 'Completed'
                                            ? 'bg-green-100 text-green-800'
                                            : ($currentStatus === 'Cancelled'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-yellow-100 text-yellow-800')))) }}">
                            <span class="relative flex h-2.5 w-2.5 mr-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                    {{ $currentStatus === 'Delivered'
                                        ? 'bg-green-400'
                                        : ($currentStatus === 'Shipped'
                                            ? 'bg-purple-400'
                                            : ($currentStatus === 'Processing'
                                                ? 'bg-blue-400'
                                                : ($currentStatus === 'Completed'
                                                    ? 'bg-green-400'
                                                    : ($currentStatus === 'Cancelled'
                                                        ? 'bg-red-400'
                                                        : 'bg-yellow-400')))) }}"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5
                                    {{ $currentStatus === 'Delivered'
                                        ? 'bg-green-500'
                                        : ($currentStatus === 'Shipped'
                                            ? 'bg-purple-500'
                                            : ($currentStatus === 'Processing'
                                                ? 'bg-blue-500'
                                                : ($currentStatus === 'Completed'
                                                    ? 'bg-green-500'
                                                    : ($currentStatus === 'Cancelled'
                                                        ? 'bg-red-500'
                                                        : 'bg-yellow-500')))) }}"></span>
                            </span>
                            {{ $currentStatus }}
                        </div>

                        @if ($trackingNumber)
                            <!-- Tracking Activity -->
                            {{-- <div id="trackingActivityBadge"
                                class="tracking-activity-badge inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                {{ $isTrackingMoving ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                <i class='bx {{ $isTrackingMoving ? 'bx-run animate-pulse' : 'bx-lock' }} mr-2'></i>
                                {{ $isTrackingMoving ? 'Active Tracking' : 'Static Tracking' }}
                            </div> --}}

                            <!-- Tracking Number -->
                            <div
                                class="flex items-center bg-white px-4 py-2 rounded-lg shadow-xs border border-gray-200">
                                <i class='bx bx-barcode mr-2 text-gray-500'></i>
                                <span class="text-sm font-medium text-gray-700">Tracking #:
                                    {{ $trackingNumber }}</span>
                            </div>

                            <!-- Last Updated -->
                            <div id="lastUpdated" class="flex items-center text-sm text-gray-600">
                                <i class='bx bx-time-five mr-1'></i>
                                @if (!empty($trackingHistory))
                                    Last Updated:
                                    {{ \Carbon\Carbon::parse(end($trackingHistory)['date'])->format('M d, Y h:i A') }}
                                @else
                                    Waiting for first update
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Shipping Details Card -->
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-map mr-2 text-blue-600'></i> Shipping Details
                        </h2>
                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex">
                                <span class="w-24 text-gray-500">Name:</span>
                                <span class="font-medium">{{ $order->name }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-24 text-gray-500">Address:</span>
                                <span>
                                    {{ $order->address_line_1 }}<br>
                                    @if ($order->address_line_2)
                                        {{ $order->address_line_2 }}<br>
                                    @endif
                                    {{ $order->barangay }}, {{ $order->city }}<br>
                                    {{ $order->province }}, {{ $order->region }} {{ $order->zip_code }}
                                </span>
                            </div>
                            {{-- <div class="flex">
                                <span class="w-24 text-gray-500">Contact:</span>
                                <span class="font-medium">{{ $order->phone }}</span>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Tracking History Card -->
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class='bx bx-history mr-2 text-blue-600'></i> Tracking History
                            </h2>
                            <span class="text-xs text-gray-500">Updates every 1-2  minutes</span>
                        </div>

                        <div id="trackingHistoryContainer">
                            @if (!empty($trackingHistory))
                                <div class="relative pl-8">
                                    <div class="absolute h-full border-l-2 border-dashed border-blue-200 left-4 top-2">
                                    </div>
                                    @foreach ($trackingHistory as $event)
                                        <div class="mb-6 relative">
                                            <div
                                                class="absolute -left-8 top-0.5 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center z-10 border-2 border-white">
                                                <i class='bx bx-check text-blue-600 text-sm'></i>
                                            </div>
                                            <div class="bg-white p-4 rounded-lg shadow-xs border border-gray-200">
                                                <div class="flex justify-between items-start">
                                                    <p class="text-sm font-medium text-gray-900">{{ $event['status'] }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($event['date'])->format('M d, h:i A') }}
                                                    </p>
                                                </div>
                                                @if (isset($event['location']))
                                                    <p class="mt-1 text-xs text-gray-500 flex items-center">
                                                        <i class='bx bx-map-pin mr-1'></i> {{ $event['location'] }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class='bx bx-package text-4xl text-gray-300 mb-2'></i>
                                    <p class="text-sm text-gray-500">No tracking updates available yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to update the tracking info
                function updateTrackingInfo() {
                    fetch("{{ route('orders.tracking-updates', $order) }}")
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            // Update current status badge
                            const statusBadge = document.getElementById('statusBadge');
                            if (statusBadge) {
                                statusBadge.textContent = data.currentStatus;

                                // Update badge color based on status
                                const badgeClasses = {
                                    'Delivered': 'bg-green-100 text-green-800',
                                    'Shipped': 'bg-purple-100 text-purple-800',
                                    'Processing': 'bg-blue-100 text-blue-800',
                                    'Completed': 'bg-green-100 text-green-800',
                                    'Cancelled': 'bg-red-100 text-red-800',
                                    'default': 'bg-yellow-100 text-yellow-800'
                                };

                                // Remove all possible color classes
                                statusBadge.className = statusBadge.className.replace(/(bg|text)-\w+-\d+/g, '');
                                // Add new classes
                                statusBadge.classList.add(
                                    'inline-flex', 'items-center', 'px-4', 'py-2', 'rounded-full',
                                    'text-sm', 'font-medium',
                                    badgeClasses[data.currentStatus] || badgeClasses.default
                                );
                            }

                            // Update tracking activity badge
                            // const trackingActivityBadge = document.getElementById('trackingActivityBadge');
                            // if (trackingActivityBadge) {
                            //     const isMoving = data.isTrackingMoving;
                            //     trackingActivityBadge.className = trackingActivityBadge.className.replace(
                            //         /(bg|text)-\w+-\d+/g, '');
                            //     trackingActivityBadge.classList.add(
                            //         'inline-flex', 'items-center', 'px-4', 'py-2', 'rounded-full',
                            //         'text-sm', 'font-medium',
                            //         isMoving ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600'
                            //     );

                            //     const icon = trackingActivityBadge.querySelector('i');
                            //     if (icon) {
                            //         icon.className = isMoving ? 'bx bx-run animate-pulse mr-2' : 'bx bx-lock mr-2';
                            //     }
                            //     trackingActivityBadge.querySelector('span').textContent =
                            //         isMoving ? 'Active Tracking' : 'Static Tracking';
                            // }

                            // Update last updated time
                            const lastUpdatedEl = document.getElementById('lastUpdated');
                            if (lastUpdatedEl && data.lastUpdated) {
                                lastUpdatedEl.innerHTML =
                                    `<i class='bx bx-time-five mr-1'></i> Last Updated: ${data.lastUpdated}`;
                            }

                            // Update tracking history if changed
                            const historyContainer = document.getElementById('trackingHistoryContainer');
                            if (historyContainer && JSON.stringify(data.trackingHistory) !==
                                JSON.stringify(@json($trackingHistory ?? []))) {

                                if (data.trackingHistory.length === 0) {
                                    historyContainer.innerHTML = `
                                <div class="text-center py-8">
                                    <i class='bx bx-package text-4xl text-gray-300 mb-2'></i>
                                    <p class="text-sm text-gray-500">No tracking updates available yet.</p>
                                </div>
                            `;
                                } else {
                                    let historyHTML = `
                                <div class="relative pl-8">
                                    <div class="absolute h-full border-l-2 border-dashed border-blue-200 left-4 top-2"></div>
                            `;

                                    data.trackingHistory.forEach(event => {
                                        historyHTML += `
                                    <div class="mb-6 relative">
                                        <div class="absolute -left-8 top-0.5 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center z-10 border-2 border-white">
                                            <i class='bx bx-check text-blue-600 text-sm'></i>
                                        </div>
                                        <div class="bg-white p-4 rounded-lg shadow-xs border border-gray-200">
                                            <div class="flex justify-between items-start">
                                                <p class="text-sm font-medium text-gray-900">${event.status}</p>
                                                <p class="text-xs text-gray-500">
                                                    ${new Date(event.date).toLocaleString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })}
                                                </p>
                                            </div>
                                            ${event.location ? `
                                                    <p class="mt-1 text-xs text-gray-500 flex items-center">
                                                        <i class='bx bx-map-pin mr-1'></i> ${event.location}
                                                    </p>` : ''}
                                        </div>
                                    </div>
                                `;
                                    });

                                    historyHTML += `</div>`;
                                    historyContainer.innerHTML = historyHTML;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching tracking updates:', error);
                            // Optionally show error to user
                        });
                }

                // Update every 1-2minutes (adjust as needed)
                setInterval(updateTrackingInfo, 120000);

                // Initial update
                updateTrackingInfo();
            });
        </script>
    @endpush
</x-app-layout>
