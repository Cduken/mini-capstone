<!-- Table with scrollable body -->
<div
    class="overflow-y-auto max-h-[350px] bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl rounded-xl shadow-xl border border-indigo-500/20">
    <table class="w-full" id="orders-table">
        <thead
            class="bg-gradient-to-r from-indigo-900/80 to-gray-900/80 text-gray-200 text-left text-sm sticky top-0 z-10 backdrop-blur-md">
            <tr>
                <th class="py-3 px-5 font-semibold tracking-wide">Order</th>
                <th class="py-3 px-5 font-semibold tracking-wide">Customer</th>
                <th class="py-3 px-5 font-semibold tracking-wide">Total</th>
                <th class="py-3 px-5 font-semibold tracking-wide">Status</th>
                <th class="py-3 px-5 font-semibold tracking-wide">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-indigo-500/20 text-white">
            @foreach ($recentOrders as $order)
                <tr class="hover:bg-indigo-800/30 transition-all duration-300 group">
                    <td class="py-4 px-5">
                        <div class="font-semibold text-white drop-shadow-md">#{{ $order->id }}</div>
                        <div class="text-xs text-gray-300">
                            {{ $order->created_at->format('M d, Y') }}
                        </div>
                    </td>
                    <td class="py-4 px-5">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-11 w-11 rounded-full bg-gradient-to-r from-cyan-500/50 to-indigo-500/50 flex items-center justify-center overflow-hidden transition-transform duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-cyan-500/30">
                                @if ($order->user && $order->user->avatar && file_exists(public_path('images/' . $order->user->avatar)))
                                    <img class="h-11 w-11 rounded-full object-cover glow-sm"
                                        src="{{ asset('images/' . $order->user->avatar) }}"
                                        alt="{{ $order->user->name ?? 'User' }}">
                                @elseif ($order->user && $order->user->profile_photo_path)
                                    <img class="h-11 w-11 rounded-full object-cover glow-sm"
                                        src="{{ asset($order->user->profile_photo_path) }}"
                                        alt="{{ $order->user->name ?? 'User' }}">
                                @else
                                    <span
                                        class="text-cyan-400 font-bold text-lg glow">{{ strtoupper(substr($order->user->name ?? 'GUEST', 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-white drop-shadow-md">
                                    {{ $order->user->name ?? 'Guest User' }}
                                </div>
                                <div class="text-xs text-gray-300">ID: {{ $order->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-5 font-semibold text-white">
                        ${{ number_format($order->total, 2) }}
                    </td>
                    <td class="py-4 px-5">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold glow-sm
                            @if ($order->status === 'completed') bg-green-500/20 text-green-300 border border-green-500/30
                            @elseif($order->status === 'pending') bg-yellow-500/20 text-yellow-300 border border-yellow-500/30
                            @elseif($order->status === 'cancelled') bg-red-500/20 text-red-300 border border-red-500/30
                            @else bg-gray-500/20 text-gray-300 border border-gray-500/30 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-4 px-5">
                        <button data-order-id="{{ $order->id }}"
                            class="text-cyan-400 hover:text-cyan-300 transition-colors duration-200 view-order-btn glow">
                            <i class='bx bx-show text-xl'></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div
    class="px-5 py-[10px] bg-gradient-to-br from-gray-800/50 to-indigo-900/50 backdrop-blur-xl border-t border-indigo-500/30 rounded-b-xl">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-gray-300">
        <div class="text-sm">
            Showing
            <span class="font-semibold text-white">{{ $recentOrders->firstItem() }}</span>
            to
            <span class="font-semibold text-white">{{ $recentOrders->lastItem() }}</span>
            of
            <span class="font-semibold text-white">{{ $recentOrders->total() }}</span> Results
        </div>

        @if ($recentOrders->hasPages())
            <nav class="flex items-center justify-center space-x-3">
                <!-- Previous Page Link -->
                @if ($recentOrders->onFirstPage())
                    <span
                        class="p-2 rounded-full bg-gray-700/50 text-gray-500 border border-gray-600/50 cursor-not-allowed transition-colors duration-200">
                        <i class='bx bx-chevron-left text-xl'></i>
                    </span>
                @else
                    <a href="{{ $recentOrders->previousPageUrl() }}"
                        class="p-2 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-500/50 hover:bg-cyan-500/40 hover:text-cyan-200 transition-all duration-300 glow-sm">
                        <i class='bx bx-chevron-left text-xl'></i>
                    </a>
                @endif

                <!-- Page Indicator -->
                <span
                    class="text-sm px-3 py-1 rounded-full  text-gray-300 ">
                    Page {{ $recentOrders->currentPage() }}
                </span>

                <!-- Next Page Link -->
                @if ($recentOrders->hasMorePages())
                    <a href="{{ $recentOrders->nextPageUrl() }}"
                        class="p-2 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-500/50 hover:bg-cyan-500/40 hover:text-cyan-200 transition-all duration-300 glow-sm">
                        <i class='bx bx-chevron-right text-xl'></i>
                    </a>
                @else
                    <span
                        class="p-2 rounded-full bg-gray-700/50 text-gray-500 border border-gray-600/50 cursor-not-allowed transition-colors duration-200">
                        <i class='bx bx-chevron-right text-xl'></i>
                    </span>
                @endif
            </nav>
        @endif
    </div>
</div>

<style>
    /* Custom Glow Effect */
    .glow {
        filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
    }

    .glow-sm {
        filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.3));
    }

    /* Glassmorphism */
    .backdrop-blur-xl {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .backdrop-blur-md {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Custom Scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.5);
        /* Cyan-inspired */
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.8);
    }

    /* Smooth Transitions */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
