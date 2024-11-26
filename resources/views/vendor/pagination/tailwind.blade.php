@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" class="disabled">Précédent</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-blue-500 hover:underline">Précédent</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-blue-500 hover:underline">Suivant</a>
        @else
            <span aria-disabled="true" class="disabled">Suivant</span>
        @endif
    </nav>
@endif