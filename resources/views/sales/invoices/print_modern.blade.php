<x-layouts.print>
    <x-slot name="title">
        {{ trans_choice('general.invoices', 1) . ': ' . $invoice->document_number }}
    </x-slot>

    <x-slot name="content">
        <x-documents.template.modern
            type="invoice"
            :document="$invoice"
        />
        @php
            $shortUrl = $invoice->short_url;
        @endphp
        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{$shortUrl}}&size=100x100&margin=0" alt="">
        <br>
        <small>
            Pay online:
            <a style="text-decoration: none; color:black" href="{{$shortUrl}}">
                {{$shortUrl}}
            </a>
        </small>
    </x-slot>
</x-layouts.print>
