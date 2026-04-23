<?php

use Livewire\Component;

new class extends Component {};

?>

<div class="bg-surface p-3 h-full flex flex-col border border-border">

    @php
        $highVolume = [1, 21];
        $activePayout = [4, 34];
        $volumes = [
            0 => '12k',
            1 => '45k',
            2 => '2k',
            4 => '8k',
            7 => '1k',
            9 => '4k',
            21 => '31k',
            34 => '19k',
        ];
    @endphp

    <div class="grid grid-cols-10 gap-1 flex-1 overflow-y-auto custom-scrollbar content-start">
        @for ($i = 0; $i <= 99; $i++)
            @php
                $num = str_pad($i, 2, '0', STR_PAD_LEFT);
                $isHigh = in_array($i, $highVolume);
                $isPayout = in_array($i, $activePayout);
                $vol = $volumes[$i] ?? '--';
            @endphp
            <div wire:key="num-{{ $i }}"
                class="border flex flex-col items-center justify-center p-1.5 cursor-pointer transition-colors
                {{ $isHigh ? 'bg-text border-text' : ($isPayout ? 'bg-overlay border-muted' : 'bg-bg border-border hover:bg-overlay') }}">
                <span class="text-[0.5rem] font-bold {{ $isHigh ? 'text-bg' : 'text-text' }}">{{ $num }}</span>
                <span
                    class="text-xs {{ $isHigh ? 'text-bg' : ($vol !== '--' ? 'text-subtext' : 'text-muted') }}">{{ $vol }}</span>
            </div>
        @endfor
    </div>
</div>
