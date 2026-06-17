@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-1.5">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <span class="px-3 py-2 rounded-lg text-sm text-white/20 border border-white/[0.04] bg-white/[0.01] cursor-not-allowed"><i class="bi bi-chevron-left"></i></span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg text-sm text-white/60 border border-white/[0.08] hover:bg-white/[0.06] hover:text-white hover:border-[#C1121F]/30 transition-colors no-underline"><i class="bi bi-chevron-left"></i></a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
        <span class="px-3 py-2 rounded-lg text-sm text-white/30 border border-white/[0.04] cursor-not-allowed">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span class="px-3.5 py-2 rounded-lg text-sm font-semibold text-white bg-[#C1121F] border border-[#C1121F] shadow-[0_0_15px_rgba(193,18,31,0.3)]">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-3.5 py-2 rounded-lg text-sm text-white/60 border border-white/[0.08] hover:bg-white/[0.06] hover:text-white hover:border-[#C1121F]/30 transition-colors no-underline">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg text-sm text-white/60 border border-white/[0.08] hover:bg-white/[0.06] hover:text-white hover:border-[#C1121F]/30 transition-colors no-underline"><i class="bi bi-chevron-right"></i></a>
    @else
    <span class="px-3 py-2 rounded-lg text-sm text-white/20 border border-white/[0.04] bg-white/[0.01] cursor-not-allowed"><i class="bi bi-chevron-right"></i></span>
    @endif
</nav>
@endif
