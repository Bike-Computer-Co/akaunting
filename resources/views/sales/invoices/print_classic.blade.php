<x-layouts.print>
    <x-slot name="title">
        {{ trans_choice('general.invoices', 1) . ': ' . $invoice->document_number }}
    </x-slot>

    <x-slot name="content">
        <x-documents.template.classic
            type="invoice"
            :document="$invoice"
        />
        @php
            $shortUrl = $invoice->short_url;
        @endphp
        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{$shortUrl}}&size=80x80&margin=0" alt="">
        <br>
        <p style="font-size: 12px; color: #424242;">
            Pay online:
            <a style="text-decoration: none; color:black" href="{{$shortUrl}}">
                {{$shortUrl}}
            </a>
        </p>
    </x-slot>
</x-layouts.print>
