@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-1.5">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <span class="px-3 py-2 rounded-lg text-sm cursor-not-allowed" style="color:var(--text-muted);border:1px solid var(--border);background:var(--bg-card)"><i class="bi bi-chevron-left"></i></span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg text-sm no-underline paginate-link" style="color:var(--text-secondary);border:1px solid var(--border);background:var(--bg-card)"><i class="bi bi-chevron-left"></i></a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
        <span class="px-3 py-2 rounded-lg text-sm cursor-not-allowed" style="color:var(--text-muted);border:1px solid var(--border)">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span class="px-3.5 py-2 rounded-lg text-sm font-semibold text-white" style="background:var(--accent);border:1px solid var(--accent);box-shadow:var(--accent-glow)">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-3.5 py-2 rounded-lg text-sm no-underline paginate-link" style="color:var(--text-secondary);border:1px solid var(--border);background:var(--bg-card)">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg text-sm no-underline paginate-link" style="color:var(--text-secondary);border:1px solid var(--border);background:var(--bg-card)"><i class="bi bi-chevron-right"></i></a>
    @else
    <span class="px-3 py-2 rounded-lg text-sm cursor-not-allowed" style="color:var(--text-muted);border:1px solid var(--border);background:var(--bg-card)"><i class="bi bi-chevron-right"></i></span>
    @endif
</nav>
@endif
