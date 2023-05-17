@if ($paginator->hasPages())
    <nav class="block mx-auto flex justify-center">
        <ul class="pagination mx-auto  mt-4 btn-group">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled btn rounded-l-none rounded-r btn-disabled"  style="border-top-right-radius: 6px!important; border-bottom-right-radius:6px!important" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="btn rounded-l-none" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled btn  rounded-none btn-disabled" aria-disabled="true">
                        <span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active btn  btn-active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="btn rounded-none" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="btn rounded-r-none" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled rounded-r-none rounded-l btn btn-disabled "
                    style="border-top-left-radius: 6px!important; border-bottom-left-radius:6px!important"
                    aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
