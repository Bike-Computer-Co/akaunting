@if ($layout == 'signed')
    <x-layouts.signed>
        <x-slot name="title">
        </x-slot>
        <x-slot name="buttons">
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div style="display: flex; flex-direction: column; align-items: center">
                    {{ trans('portal.payment_received') }}
                    <div class="mt-4">
                        <x-layouts.portal.finish.buttons :invoice="$invoice"/>
                    </div>
                    <x-layouts.portal.finish.content :invoice="$invoice"/>
                </div>
            </div>
        </x-slot>
    </x-layouts.signed>
@else
    <x-layouts.portal>
        <x-slot name="title">
        </x-slot>

        <x-slot name="buttons">
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div style="display: flex; flex-direction: column; align-items: center">
                    {{ trans('portal.payment_received') }}
                    <div class="mt-4">
                        <x-layouts.portal.finish.buttons :invoice="$invoice"/>
                    </div>
                    <x-layouts.portal.finish.content :invoice="$invoice"/>
                </div>
            </div>
        </x-slot>
    </x-layouts.portal>
@endif
