{{-- Desktop: left sidebar --}}
<aside class="w-14 shrink-0 bg-surface hidden md:flex flex-col py-4 items-center justify-between border-r border-border z-40">
    <div class="flex flex-col gap-6 items-center w-full">
        <div class="w-10 h-10 bg-accent flex items-center justify-center text-bg shrink-0">
            <span class="material-symbols-outlined icon-fill">point_of_sale</span>
        </div>
        <div class="flex flex-col gap-4 w-full items-center">
            <div class="p-3 text-muted hover:text-text transition-all cursor-pointer">
                <span class="material-symbols-outlined">query_stats</span>
            </div>
            <div class="p-3 text-muted hover:text-text transition-all cursor-pointer">
                <span class="material-symbols-outlined">receipt_long</span>
            </div>
        </div>
    </div>
    <div class="p-3 text-muted hover:text-text transition-all cursor-pointer">
        <span class="material-symbols-outlined">person</span>
    </div>
</aside>

{{-- Mobile: bottom tab bar --}}
<nav class="md:hidden fixed bottom-0 inset-x-0 h-16 bg-surface border-t border-border flex items-center justify-around z-50">
    <div class="flex flex-col items-center gap-1 cursor-pointer">
        <div class="w-8 h-8 bg-accent flex items-center justify-center text-bg">
            <span class="material-symbols-outlined icon-fill text-base">point_of_sale</span>
        </div>
        <span class="text-4xs uppercase font-bold text-text tracking-wider">Terminal</span>
    </div>
    <div class="flex flex-col items-center gap-1 cursor-pointer">
        <span class="material-symbols-outlined text-muted">query_stats</span>
        <span class="text-4xs uppercase font-bold text-muted tracking-wider">Analytics</span>
    </div>
    <div class="flex flex-col items-center gap-1 cursor-pointer">
        <span class="material-symbols-outlined text-muted">receipt_long</span>
        <span class="text-4xs uppercase font-bold text-muted tracking-wider">Ledger</span>
    </div>
    <div class="flex flex-col items-center gap-1 cursor-pointer">
        <span class="material-symbols-outlined text-muted">person</span>
        <span class="text-4xs uppercase font-bold text-muted tracking-wider">Account</span>
    </div>
</nav>
