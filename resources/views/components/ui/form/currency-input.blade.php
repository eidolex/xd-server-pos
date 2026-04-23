@props([
    'prefix' => '$',
    'placeholder' => '0.00',
])

<div class="flex items-center border-b-2 border-muted focus-within:border-line transition-colors">
    <span class="pl-3 text-subtext text-sm shrink-0">{{ $prefix }}</span>
    <input
        type="text"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'bg-transparent border-none focus:outline-none text-text text-xl font-bold p-3 w-full placeholder:text-muted']) }}
    />
</div>
