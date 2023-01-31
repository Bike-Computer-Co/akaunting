<x-layouts.print>
    <x-slot name="title">
        {{ trans_choice('general.invoices', 1) . ': ' . $invoice->document_number }}
    </x-slot>

    <x-slot name="content">
        <x-documents.template.modern
            type="invoice"
            :document="$invoice"
        />
{{--        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{$invoice->short_url}}&size=80x80&margin=0" alt="">--}}
        <br>
{{--        <p style="font-size: 12px; color: #424242;">--}}
{{--            Pay online:--}}
{{--            <a style="text-decoration: none; color:black" href="{{$invoice->short_url}}">--}}
{{--                {{$invoice->short_url}}--}}
{{--            </a>--}}
{{--        </p>--}}
    </x-slot>
</x-layouts.print>
