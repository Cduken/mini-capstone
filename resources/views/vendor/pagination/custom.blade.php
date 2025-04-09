@if ($paginator->hasPages())
    <nav class="flex items-center justify-end space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="p-2 rounded-full border border-gray-600/30 text-gray-400 cursor-not-allowed transition-colors glow">
                <i class='bx bx-chevron-left text-lg'></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="p-2 rounded-full border border-gray-600/30 text-gray-200 hover:bg-indigo-500/20 hover:border-indigo-500/50 hover:text-white transition-colors duration-200 glow">
                <i class='bx bx-chevron-left text-lg'></i>
            </a>
        @endif

        {{-- Simple Page Indicator --}}
        <span class="text-xs text-gray-300 px-2">
            Page {{ $paginator->currentPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="p-2 rounded-full border border-gray-600/30 text-gray-200 hover:bg-indigo-500/20 hover:border-indigo-500/50 hover:text-white transition-colors duration-200 glow">
                <i class='bx bx-chevron-right text-lg'></i>
            </a>
        @else
            <span
                class="p-2 rounded-full border border-gray-600/30 text-gray-400 cursor-not-allowed transition-colors glow">
                <i class='bx bx-chevron-right text-lg'></i>
            </span>
        @endif
    </nav>
@endif
