<div class="overflow-x-auto -mx-1 px-1">
    <div class="flex gap-1 p-1 rounded-xl bg-white/[0.03] border border-white/[0.06] w-max min-w-full sm:min-w-0">
        <a href="/laporan/ringkasan"
            class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all no-underline whitespace-nowrap
            {{ request()->is('laporan/ringkasan') || (request()->is('laporan') && !request()->is('laporan/awal*') && !request()->is('laporan/akhir*'))
                ? 'bg-[#C1121F] text-white shadow-[0_0_20px_-4px_rgba(193,18,31,0.6)]'
                : 'text-white/60 hover:text-white hover:bg-white/[0.05]' }}">
            <i class="bi bi-bar-chart mr-1.5"></i> Ringkasan
        </a>
        <a href="/laporan/awal"
            class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all no-underline whitespace-nowrap
            {{ request()->is('laporan/awal*')
                ? 'bg-[#C1121F] text-white shadow-[0_0_20px_-4px_rgba(193,18,31,0.6)]'
                : 'text-white/60 hover:text-white hover:bg-white/[0.05]' }}">
            <i class="bi bi-file-earmark-text mr-1.5"></i> Awal
        </a>
        <a href="/laporan/akhir"
            class="inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all no-underline whitespace-nowrap
            {{ request()->is('laporan/akhir*')
                ? 'bg-[#C1121F] text-white shadow-[0_0_20px_-4px_rgba(193,18,31,0.6)]'
                : 'text-white/60 hover:text-white hover:bg-white/[0.05]' }}">
            <i class="bi bi-journal-text mr-1.5"></i> Akhir
        </a>
    </div>
</div>
