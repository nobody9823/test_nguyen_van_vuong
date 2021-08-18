@if ($props->first() !== null)
<div class="pager E-font">
    <ul class="pagination">
        @if ($props->previousPageUrl() !== null)
            <li class="pager_pre"><a href="{{ $props->appends(request()->input())->previousPageUrl() }}"><span>«</span></a></li>
        @endif
        @foreach ($props->appends(request()->input())->links()->elements[0] as $key => $link)
            <li><a href="{{ $link }}" class="{{ $props->currentPage() == $key ? 'pager_active' : ''}}"><span>{{ $key }}</span></a></li>
        @endforeach
        @if ($props->nextPageUrl() !== null)
            <li class="pager_next"><a href="{{ $props->appends(request()->input())->nextPageUrl() }}"><span>»</span></a></li>
        @endif
    </ul>
</div>
@endif