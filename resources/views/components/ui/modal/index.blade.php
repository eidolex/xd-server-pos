@props([
    'lockScroll' => true,
])

<dialog
    {{ $attributes->twMerge('ui-modal-dialog bg-transparent p-0 m-auto backdrop:bg-black/60 backdrop:backdrop-blur-sm', $lockScroll ? 'lock-scroll' : '') }}>
    {{ $slot }}
</dialog>
