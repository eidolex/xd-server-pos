@props([])

<select {{ $attributes->merge(['class' => 'w-full bg-bg border border-border text-text text-sm p-3 appearance-none cursor-pointer focus:outline-none focus:border-line transition-colors']) }}>
    {{ $slot }}
</select>
