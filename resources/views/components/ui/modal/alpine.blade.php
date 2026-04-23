@props(['openProperty', 'backdropClose' => true])

@php
    $script = <<<'SCRIPT'
        {
            init() {
                $watch('__open_property__', (newValue, oldValue) => {
                    if (newValue === oldValue) {
                        return;
                    }
                    if (newValue) {
                        this.$el.showModal();
                    } else {
                        this.$el.close();
                    }
                });
                this.$el.addEventListener('close', () => {
                    this['__open_property__'] = false;
                });

                if (__backdrop_close__) {
                    this.$el.addEventListener('click', (e) => {
                        if (e.target === this.$el) {
                            this['__open_property__'] = false;
                        }
                    });
                }
            },
        }
    SCRIPT;

    $script = str_replace('__open_property__', $openProperty, $script);
    $script = str_replace('__backdrop_close__', $backdropClose ? 'true' : 'false', $script);
@endphp

<x-ui.modal.index :attributes="$attributes->merge(['x-data' => $script])">
    {{ $slot }}
</x-ui.modal.index>
