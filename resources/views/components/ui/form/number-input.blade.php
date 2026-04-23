@props([
    'value' => '1.0',
    'suffix' => 'X',
])

<div class="flex items-center border border-border bg-bg overflow-hidden focus-within:border-line transition-colors">
    <input
        type="number"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'bg-transparent border-none focus:outline-none text-text text-sm p-3 w-full']) }}
    />
    <span class="px-3 text-text text-xs font-bold shrink-0">{{ $suffix }}</span>
</div>
