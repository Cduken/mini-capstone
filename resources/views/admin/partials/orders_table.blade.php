<!-- Table with scrollable body -->
<div class="overflow-y-auto max-h-[350px]">
    <table class="w-full" id="orders-table">
        <thead class="bg-gray-50 text-gray-600 text-left text-sm sticky top-0">
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
                    <td class="py-4 px-5 font-medium">
                        ${{ number_format($order->total, 2) }}
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
                        <button data-order-id="{{ $order->id }}"
                                class="text-blue-600 hover:text-blue-800 view-order-btn">
                            <i class='bx bx-show text-xl'></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination outside the scrollable area -->
<div class="px-5 py-4 border-t border-gray-100">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-500">
            Showing
            <span class="font-semibold">{{ $recentOrders->firstItem() }}</span>
            to
            <span class="font-semibold">{{ $recentOrders->lastItem() }}</span>
            of
            <span class="font-semibold">{{ $recentOrders->total() }}</span> Results
        </div>

        @if ($recentOrders->hasPages())
            <nav class="flex items-center space-x-1">
                {{-- Previous Page Link --}}
                @if ($recentOrders->onFirstPage())
                    <span class="p-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
                        <i class='bx bx-chevron-left text-xl'></i>
                    </span>
                @else
                    <a href="{{ $recentOrders->previousPageUrl() }}"
                       class="p-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors pagination-link">
                        <i class='bx bx-chevron-left text-xl'></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($recentOrders->getUrlRange(1, $recentOrders->lastPage()) as $page => $url)
                    @if ($page == $recentOrders->currentPage())
                        <span class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 border border-blue-200 font-medium">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors pagination-link">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($recentOrders->hasMorePages())
                    <a href="{{ $recentOrders->nextPageUrl() }}"
                       class="p-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors pagination-link">
                        <i class='bx bx-chevron-right text-xl'></i>
                    </a>
                @else
                    <span class="p-2 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
                        <i class='bx bx-chevron-right text-xl'></i>
                    </span>
                @endif
            </nav>
        @endif
    </div>
</div>
