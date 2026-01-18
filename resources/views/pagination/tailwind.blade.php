@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <div class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 rounded-full bg-primary text-[#181811] font-bold text-sm shadow-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 font-bold text-sm text-[#181811] dark:text-white hover:bg-white dark:hover:bg-[#32311b] hover:border-primary transition-colors shadow-sm">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            @else
                <span class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-600 text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
            @endif
        </div>
    </nav>
@endif

