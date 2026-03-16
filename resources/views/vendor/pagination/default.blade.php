@if ($paginator->hasPages())
<nav class="pagination-wrap" role="navigation" aria-label="Pagination Navigation">
    <div class="pagination-list">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <span class="pagination-item pagination-disabled">Previous</span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item" rel="prev">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <span class="pagination-item pagination-disabled">{{ $element }}</span>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span class="pagination-item pagination-active">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item" rel="next">Next</a>
        @else
        <span class="pagination-item pagination-disabled">Next</span>
        @endif

    </div>
</nav>
@endif