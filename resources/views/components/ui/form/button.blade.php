@props([
    'variant' => 'secondary',
    'full' => false,
])

@php
$base = 'py-3 text-xs font-bold uppercase tracking-widest transition-all active:scale-95 cursor-pointer';
$width = $full ? 'w-full' : '';
$variants = [
    'primary'   => 'bg-text text-bg hover:bg-accent-dim px-10 py-3.5 font-extrabold',
    'secondary' => 'bg-overlay text-text hover:bg-text hover:text-bg border border-border px-6',
    'ghost'     => 'text-subtext hover:text-text px-4',
];
$variantClass = $variants[$variant] ?? $variants['secondary'];
@endphp

<button {{ $attributes->merge(['class' => trim("$base $width $variantClass")]) }}>
    {{ $slot }}
</button>
