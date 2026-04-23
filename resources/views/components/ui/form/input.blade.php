@props([
    'type' => 'text',
    'placeholder' => '',
])

<input
    type="{{ $type }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'w-full bg-bg border border-border text-text text-sm p-3 placeholder:text-muted focus:outline-none focus:border-line transition-colors']) }}
/>
