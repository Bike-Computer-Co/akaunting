@stack('save_buttons_start')
    <div
        @class([
            'flex items-center justify-end',
            $groupClass,
        ])
    >
        @if (! $withoutCancel)
            <x-link href="{{ $cancel }}" class="{{ $cancelClass }}" override="class">
                {{ $cancelText }}
            </x-link>
        @endif

        <x-button
            type="submit"
            class="relative flex items-center justify-center bg-blue hover:bg-blue-700 text-white px-6 py-1.5 text-base rounded-lg disabled:bg-blue-100"
            ::disabled="{!! $saveDisabled !!}"
            override="class"
        >
            <x-button.loading action="{!! $saveLoading !!}">
                {{ trans('general.save') }}
            </x-button.loading>
        </x-button>
    </div>
@stack('save_buttons_end')
