@if ($paginator->hasPages())
    <nav class="flex items-center space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="p-[6px] rounded-lg border border-gray-200 text-gray-400 hover:border-blue-200 hover:bg-blue-100 hover:bg-opacity-30 cursor-not-allowed">
                <i class='bx bx-chevron-left text-xl'></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="p-[6px] rounded-lg border border-gray-200 text-gray-600 transition-colors hover:border-blue-200 hover:bg-blue-100 hover:bg-opacity-30">
                <i class='bx bx-chevron-left text-xl'></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 border border-blue-200 font-medium">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="p-[6px] rounded-lg border border-gray-200 text-gray-600transition-colors hover:border-blue-200 hover:bg-blue-100 hover:bg-opacity-30">
                <i class='bx bx-chevron-right text-xl'></i>
            </a>
        @else
            <span class="p-[6px] rounded-lg border border-gray-200 text-gray-400 hover:border-blue-200 hover:bg-blue-100 hover:bg-opacity-30" cursor-not-allowed">
                <i class='bx bx-chevron-right text-xl'></i>
            </span>
        @endif
    </nav>
@endif
