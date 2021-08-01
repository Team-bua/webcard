
<style>
    a.disabled {
    pointer-events: none;
    cursor: default;
}
</style>
@if ($paginator->hasPages())
    <ul class="pagination pagination-primary justify-content-end" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a class="page-link disabled"><span class="fa fa-angle-left"></span></a>
        @else
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span class="fa fa-angle-left"></span></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <a class="page-numbers disabled" href="#">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <nav><a class="page-numbers page-link" aria-current="page">{{ $page }}</a></nav>
                    @else
                    <nav><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></nav>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><span class="fa fa-angle-right"></span></a>
        @else
        <a class="page-link disabled" href="{{ $paginator->nextPageUrl() }}"><span class="fa fa-angle-right"></span></a></li>
        @endif
    </ul>
@endif
