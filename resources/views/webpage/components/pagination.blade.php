@if ($paginator->hasPages())
    <div class="custom-pagination-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:void(0)" class="custom-prev-1 custom-disabled-1" aria-disabled="true"
                aria-label="Página anterior">«</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="custom-prev-1" aria-label="Página anterior">«</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="custom-page-1 custom-disabled-1" aria-disabled="true">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="javascript:void(0)" class="custom-page-1 custom-active-1"
                            aria-current="page">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="custom-page-1">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="custom-next-1" aria-label="Página siguiente">»</a>
        @else
            <a href="javascript:void(0)" class="custom-next-1 custom-disabled-1" aria-disabled="true"
                aria-label="Página siguiente">»</a>
        @endif
    </div>
@endif
