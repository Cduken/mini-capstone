<x-app-layout>
    <div class="py-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Track Order #{{ $order->id }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Follow your order's journey</p>
                </div>
                <a href="{{ route('purchases.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class='bx bx-arrow-back mr-2'></i> Back to Orders
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <!-- Tracking Status -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Current Status</h2>
                    <div class="flex items-center flex-wrap gap-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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
                            <span class="relative flex h-2 w-2 mr-2">
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
                                    class="relative inline-flex rounded-full h-2 w-2
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
                        </span>
                        @if ($trackingNumber)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $isTrackingMoving ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                <i class='bx {{ $isTrackingMoving ? 'bx-run animate-pulse' : 'bx-lock' }} mr-2'></i>
                                {{ $isTrackingMoving ? 'Active Tracking' : 'Static Tracking' }}
                            </span>
                            <span class="ml-4 text-sm text-gray-600">
                                Tracking #: {{ $trackingNumber }}
                            </span>
                            @if (!empty($trackingHistory))
                                <span class="ml-4 text-sm text-gray-600">
                                    Last Updated:
                                    {{ \Carbon\Carbon::parse(end($trackingHistory)['date'])->format('F j, Y, g:i A') }}
                                </span>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Shipping Details</h2>
                    <div class="text-sm text-gray-600">
                        <p>{{ $order->name }}</p>
                        <p>{{ $order->address_line_1 }}</p>
                        @if ($order->address_line_2)
                            <p>{{ $order->address_line_2 }}</p>
                        @endif
                        <p>{{ $order->barangay }}, {{ $order->city }}</p>
                        <p>{{ $order->province }}, {{ $order->region }}</p>
                        <p>{{ $order->zip_code }}</p>
                    </div>
                </div>

                <!-- Tracking History -->
                @if (!empty($trackingHistory))
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Tracking History</h2>
                        <div class="relative">
                            <div class="absolute h-full border border-dashed border-gray-300 left-4"></div>
                            @foreach ($trackingHistory as $event)
                                <div class="mb-8 flex items-start">
                                    <div
                                        class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center z-10">
                                        <i class='bx bx-check text-blue-600'></i>
                                    </div>
                                    <div class="ml-6">
                                        <p class="text-sm font-medium text-gray-900">{{ $event['status'] }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($event['date'])->format('F j, Y, g:i A') }}</p>
                                        @if (isset($event['location']))
                                            <p class="text-sm text-gray-500">{{ $event['location'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Tracking History</h2>
                        <p class="text-sm text-gray-500">No tracking updates available yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
