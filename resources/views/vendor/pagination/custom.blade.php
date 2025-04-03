@if ($paginator->hasPages())
    <nav class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="p-2 rounded-full border border-gray-200 text-gray-400 cursor-not-allowed transition-colors">
                <i class='bx bx-chevron-left text-xl'></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-300 hover:text-blue-600 transition-colors duration-200">
                <i class='bx bx-chevron-left text-xl'></i>
            </a>
        @endif

        {{-- Simple Page Indicator --}}
        <span class="text-sm text-gray-500 px-2">
            Page {{ $paginator->currentPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="p-2 rounded-full border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-300 hover:text-blue-600 transition-colors duration-200">
                <i class='bx bx-chevron-right text-xl'></i>
            </a>
        @else
            <span class="p-2 rounded-full border border-gray-200 text-gray-400 cursor-not-allowed transition-colors">
                <i class='bx bx-chevron-right text-xl'></i>
            </span>
        @endif
    </nav>
@endif
