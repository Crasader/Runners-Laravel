@if ($paginator->hasPages())
<div class="columns">
    <div class="column is-12">
        <nav class="pagination is-centered" role="navigation" aria-label="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="pagination-previous" title="This is the first page" disabled>{{__('pagination.previous')}}</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" rel="prev">{{__('pagination.previous')}}</a>
            @endif

            <ul class="pagination-list">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><a class="pagination-link is-current" aria-label="{{ $page }}" aria-current="page">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}" class="pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next">{{__('pagination.next')}}</a>
            @else
                <a class="pagination-next" title="This is the last page" disabled>{{__('pagination.next')}}</a>
            @endif
        </nav>
    </div>
</div>
@endif
