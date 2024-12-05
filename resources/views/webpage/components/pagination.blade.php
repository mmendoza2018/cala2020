@if ($paginator->hasPages())
    <ul
        class="custom-pagination pt-xxl-20 pt-xl-15 pt-10 d-flex align-items-center justify-content-center gap-xxl-3 gap-2">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <a href="javascript:void(0)" class="cmn-60 d-center radius-circle nw1-clr pagi-bg disabled">
                    <i class="ph ph-caret-left n4-clr fs20"></i>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="cmn-60 d-center radius-circle nw1-clr pagi-bg">
                    <i class="ph ph-caret-left n4-clr fs20"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                    <a href="javascript:void(0)"
                        class="cmn-60 d-center radius-circle n4-clr pagi-bg fs20 fw_700 disabled">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a href="javascript:void(0)"
                                class="cmn-60 d-center radius-circle n4-clr pagi-bg fs20 fw_700 active">{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}"
                                class="cmn-60 d-center radius-circle n4-clr pagi-bg fs20 fw_700">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="cmn-60 d-center radius-circle nw1-clr pagi-bg">
                    <i class="ph ph-caret-right n4-clr fs20"></i>
                </a>
            </li>
        @else
            <li>
                <a href="javascript:void(0)" class="cmn-60 d-center radius-circle nw1-clr pagi-bg disabled">
                    <i class="ph ph-caret-right n4-clr fs20"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
