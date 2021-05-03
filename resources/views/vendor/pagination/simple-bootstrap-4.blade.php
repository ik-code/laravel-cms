@if ($paginator->hasPages())


            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                    <span class=" btn btn-primary float-left disabled">← Newer Posts</span>

            @else

                    <a class="btn btn-primary float-left" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Newer Posts</a>

            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

                    <a class="btn btn-primary float-right" href="{{ $paginator->nextPageUrl() }}" rel="next">Older Posts →</a>

            @else

                    <span class="btn btn-primary float-right disabled">Older Posts →</span>

            @endif


@endif
