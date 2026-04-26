@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Paginación">
        @if ($paginator->onFirstPage())
            <span class="pagination-link is-disabled" aria-disabled="true">« Anterior</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">« Anterior</a>
        @endif

        <span class="pagination-info">
            Página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
        </span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">Siguiente »</a>
        @else
            <span class="pagination-link is-disabled" aria-disabled="true">Siguiente »</span>
        @endif
    </nav>
@endif
