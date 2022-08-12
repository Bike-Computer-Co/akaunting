<x-layouts.print>
    <x-slot name="title">
        {{ trans_choice('general.invoices', 1) . ': ' . $invoice->document_number }}
    </x-slot>

    <x-slot name="content">
        <x-documents.template.modern
            type="invoice"
            :document="$invoice"
        />
        <img src="https://api.qrserver.com/v1/create-qr-code/?data={{URL::signedRoute('signed.invoices.show', [$invoice->id])}}&size=100x100&margin=0" alt="">
        <br>
        <small>
            Pay online:
            <a style="text-decoration: none; color:black" href="{{URL::signedRoute('signed.invoices.show', [$invoice->id])}}">
                {{URL::signedRoute('signed.invoices.show', [$invoice->id])}}
            </a>
        </small>
    </x-slot>
</x-layouts.print>
