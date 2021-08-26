@if ($paginator->hasPages())
<div class="pager E-font">
    <ul class="pagination">

        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li class="pager_pre">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><span>&lsaquo;</span></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><a><span>{{ $element }}</span></a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                <li>
                    <a href="{{ $url }}" class="{{ $paginator->currentPage() == $page ? 'pager_active' : ''}}">
                        <span>{{ $page }}</span>
                    </a>
                </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pager_next"><a href="{{ $paginator->nextPageUrl() }}"><span>&rsaquo;</span></a></li>
        @endif

    </ul>
</div>
@endif
