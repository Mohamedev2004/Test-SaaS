@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center flex-wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link px-3">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            @php
                $totalPages = $paginator->lastPage();
                $currentPage = $paginator->currentPage();
                $maxVisible = 5; // Maximum page links to show (including first/last)
                $sideLinks = 1; // Number of pages to show around current page
            @endphp

            {{-- Always show first page --}}
            @if ($totalPages > 1)
                <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
            @endif

            {{-- Dynamic middle pages --}}
            @if ($totalPages > 2)
                @php
                    $start = max(2, $currentPage - $sideLinks);
                    $end = min($totalPages - 1, $currentPage + $sideLinks);

                    // Adjust if we're near the start or end
                    if ($currentPage <= $sideLinks + 1) {
                        $end = min($totalPages - 1, $maxVisible - 1);
                    }
                    elseif ($currentPage >= $totalPages - $sideLinks) {
                        $start = max(2, $totalPages - ($maxVisible - 1));
                    }
                @endphp

                {{-- Show left ellipsis if needed --}}
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                {{-- Middle page links --}}
                @for ($page = $start; $page <= $end; $page++)
                    <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endfor

                {{-- Show right ellipsis if needed --}}
                @if ($end < $totalPages - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- Always show last page if more than 1 page --}}
            @if ($totalPages > 1)
                <li class="page-item {{ $currentPage == $totalPages ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link px-3" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link px-3">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
