{{-- Matches the site's own .pagination CSS. Laravel 11 ships Tailwind
     markup by default, which this project has no stylesheet for. --}}
@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="is-disabled" aria-hidden="true">&larr;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">&larr;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="is-disabled" aria-hidden="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="is-current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">&rarr;</a>
        @else
            <span class="is-disabled" aria-hidden="true">&rarr;</span>
        @endif
    </nav>
@endif
