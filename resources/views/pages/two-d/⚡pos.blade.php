<?php

new class extends \Livewire\Component {};

?>

<div class="flex flex-1 flex-wrap overflow-y-auto @container/page">

    {{-- ══ LEFT: Stats + Number Matrix ══ --}}
    <div class="flex-1 @container min-w-0 flex flex-col min-h-0 border-r border-border">
        @php
            $betAmount = 1000;
            $payoutAmount = 1000;
            $limit = 100;
            $netTime = 10;
            $payoutPercentage = 10;
            $commissionPercentage = 10;
            $grossAmount = 1100;
            $commissionAmount = 100;
        @endphp

        {{-- Stats Grid --}}
        <section class="p-4 grid @md:grid-cols-4 grid-cols-2 gap-3 shrink-0">
            <div class="bg-surface p-3 flex flex-col justify-between border-l-4 border-muted">
                <span class="text-2xs uppercase tracking-wider text-subtext font-bold">Sale</span>
                <div class="flex items-baseline gap-2 flex-wrap">
                    <span class="text-lg font-headline font-extrabold">{{ number_format($betAmount) }}</span>
                </div>
            </div>
            <div class="bg-surface p-3 flex flex-col justify-between border-l-4 border-muted">
                <span class="text-2xs uppercase tracking-wider text-subtext font-bold">Net
                    ({{ number_format($limit) }})</span>
                <div class="flex items-baseline gap-2 flex-wrap">
                    <span class="text-lg font-headline font-extrabold">{{ number_format($betAmount) }}</span>
                    <span class="text-[10px] text-sp-secondary font-bold">{{ $netTime }}%</span>
                </div>
            </div>
            <div class="bg-surface p-3 flex flex-col justify-between border-l-4 border-muted">
                <span class="text-2xs uppercase tracking-wider text-subtext font-bold">Gross
                    <span>{{ $commissionPercentage }}%</span></span>
                <div class="flex items-baseline gap-2 flex-wrap">
                    <span class="text-lg font-headline font-extrabold">
                        {{ number_format($grossAmount) }}
                    </span>
                    <span class="text-[10px] text-sp-destructive font-bold">
                        -{{ number_format($commissionAmount) }}
                    </span>
                </div>
            </div>
            <div class="bg-panel p-3 flex flex-col justify-between border-l-4 border-accent">
                <span class="text-2xs uppercase tracking-wider text-subtext font-bold">P/L
                    <span>{{ $payoutPercentage }}%</span></span>
                <div class="">
                    <span
                        class="text-lg font-headline font-extrabold">{{ number_format($grossAmount - $payoutAmount) }}</span>
                    <span class="text-[10px] text-sp-secondary font-bold">
                        -{{ number_format($payoutAmount) }}
                    </span>
                </div>
            </div>
        </section>

        {{-- Number Matrix --}}
        <section class="px-4 pb-4 flex-1 min-h-0 overflow-hidden">
            <livewire:pages::two-d.partials.two-d-grid />
        </section>
    </div>

    {{-- ══ RIGHT: Entry Form + Bet Slip ══ --}}
    <div class="w-full min-w-0 @min-[800px]/page:w-auto @min-[800px]/page:min-w-100 flex flex-col bg-surface p-4 gap-4">

        {{-- Quick Entry Form --}}
        <form class="bg-panel border border-border p-5 shrink-0">
            {{-- <span class="text-2xs uppercase tracking-widest font-bold text-subtext block mb-4">Quick Entry Form</span> --}}

            {{-- Row 1: User · Multiplier · Commission --}}
            <div class="flex gap-4 flex-wrap">
                <div class="grow flex flex-col gap-1.5">
                    <x-ui.form.label>User</x-ui.form.label>
                    <x-ui.form.input placeholder="Search user…" />
                </div>
                <div class="max-w-20 flex flex-col gap-1.5">
                    <x-ui.form.label>Multiplier</x-ui.form.label>
                    <x-ui.form.input type="number" placeholder="1" />
                </div>
                <div class="max-w-20 flex flex-col gap-1.5">
                    <x-ui.form.label>Commission</x-ui.form.label>
                    <x-ui.form.input type="number" placeholder="0" />
                </div>
            </div>

            {{-- Row 2: Number · Amount --}}
            <div class="flex gap-4 flex-wrap mt-4">
                <div class="max-w-25 flex flex-col gap-1.5">
                    <x-ui.form.label>Number</x-ui.form.label>
                    <x-ui.form.input placeholder="e.g. 01R" maxlength="6" />
                </div>
                <div class="grow flex flex-col gap-1.5">
                    <x-ui.form.label>Amount</x-ui.form.label>
                    <x-ui.form.input type="number" placeholder="50" min="50" step="50" />
                </div>
            </div>

            <x-ui.form.button :full="true" class="mt-5">Add to Slip</x-ui.form.button>
        </form>

        {{-- Bet Slip --}}
        <div class="bg-panel border border-border flex-1 flex flex-col min-h-0 min-w-0">

            <div class="flex justify-between items-center p-5 shrink-0">
                <span class="text-2xs uppercase tracking-widest font-bold text-subtext">Current Bet Slip</span>
                <span class="text-2xs font-bold bg-text text-bg px-3 py-1 rounded-full">0 ITEMS</span>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-border">
                            <th class="pb-3 px-5 text-3xs uppercase text-muted font-bold">#</th>
                            <th class="pb-3 px-5 text-3xs uppercase text-muted font-bold">Num</th>
                            <th class="pb-3 px-2 text-3xs uppercase text-muted font-bold">Amount</th>
                            <th class="pb-3 px-5 w-8"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-text">
                        {{-- Rows rendered by Livewire when logic is added --}}
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="border-t border-border p-3 shrink-0">
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-2xs uppercase text-muted font-bold block mb-1">Total Wager</span>
                        <span class="text-xl font-headline font-extrabold text-text">$0.00</span>
                    </div>
                    <div class="flex gap-2">
                        <x-ui.form.button variant="primary">Sale [F1]</x-ui.form.button>
                        <x-ui.form.button variant="primary">Carry [F9]</x-ui.form.button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
