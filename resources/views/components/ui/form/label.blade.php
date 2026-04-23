@props([])

<label {{ $attributes->merge(['class' => 'text-2xs text-subtext uppercase font-bold tracking-wider opacity-70']) }}>
    {{ $slot }}
</label>
