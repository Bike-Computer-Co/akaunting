<div class="print-template">
    <div class="row">
        <div class="col-100">
            <div class="text text-dark">
                <h3>
                    {{ $textDocumentTitle }}
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-58">
            <div class="text">
                @stack('company_logo_start')
                @if (! $hideCompanyLogo)
                    @if (!empty($document->contact->logo) && !empty($document->contact->logo->id))
                        <img  class="c-logo w-image" src="{{ $logo }}" alt="{{ $document->contact_name }}"/>
                    @else
                        <img  class="c-logo w-image" src="{{ $logo }}" alt="{{ setting('company.name') }}" />
                    @endif
                @endif
                @stack('company_logo_end')
            </div>
        </div>

        <div class="col-42">
            <div class="text right-column">
                @stack('company_details_start')
                @if ($textDocumentSubheading)
                    <p class="text-normal font-semibold">
                        {{ $textDocumentSubheading }}
                    </p>
                @endif

                @if (! $hideCompanyDetails)
                    @if (! $hideCompanyName)
                        <p>{{ setting('company.name') }}</p>
                    @endif

                    @if (! $hideCompanyAddress)
                        <p>
                            {!! nl2br(setting('company.address')) !!}
                            {!! $document->company->location !!}
                        </p>
                    @endif

                    @if (! $hideCompanyTaxNumber)
                        @if (setting('company.tax_number'))
                            <p>
                                <span class="text-medium text-default">
                                    {{ trans('general.tax_number') }}:
                                </span>
                                {{ setting('company.tax_number') }}
                            </p>
                        @endif
                    @endif

                    @if (! $hideCompanyPhone)
                        @if (setting('company.phone'))
                            <p>
                                {{ setting('company.phone') }}
                            </p>
                        @endif
                    @endif

                    @if (! $hideCompanyEmail)
                        <p class="small-text">
                            {{ setting('company.email') }}
                        </p>
                    @endif
                @endif
                <p class="small-text">
                    {{setting('invoice.accounts')}}
                </p>
                @stack('company_details_end')
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-33">
            <div class="invoice-classic-line mb-1 mt-4" style="background-color:{{ $backgroundColor }};"></div>
            <div class="invoice-classic-line" style="background-color:{{ $backgroundColor }};"></div>
        </div>

        <div class="col-33">
            <div class="invoice-classic-frame ml-1 mt-1" style="border: 1px solid {{ $backgroundColor }}">
                <div class="invoice-classic-inline-frame text-center" style="border: 1px solid {{ $backgroundColor }}">
                    @stack('invoice_number_input_start')
                    @if (! $hideDocumentNumber)
                        <div class="text small-text text-bold mt-classic">
                            <span>
                                {{ trans($textDocumentNumber) }}:
                            </span>

                            <br>

                            {{ $document->document_number }}
                        </div>
                    @endif
                    @stack('invoice_number_input_end')
                </div>
            </div>
        </div>

        <div class="col-33">
            <div class="invoice-classic-line mb-1 mt-4" style="background-color:{{ $backgroundColor }};"></div>
            <div class="invoice-classic-line" style="background-color:{{ $backgroundColor }};"></div>
        </div>
    </div>

    <div class="row top-spacing">
        <div class="col-60">
            <div class="text p-index-left">
                @if (! $hideContactInfo)
                    <p class="text-bold mb-0">
                        {{ trans($textContactInfo) }}
                    </p>
                @endif

                @stack('name_input_start')
                    @if (! $hideContactName)
                        <p>
                            {{ $document->contact_name }}
                        </p>
                    @endif
                @stack('name_input_end')

                @stack('address_input_start')
                    @if (! $hideContactAddress)
                        <p>
                            {!! nl2br($document->contact_address) !!}
                            <br>
                            {!! $document->contact_location !!}
                        </p>
                    @endif
                @stack('address_input_end')

                @stack('tax_number_input_start')
                    @if (! $hideContactTaxNumber)
                        @if ($document->contact_tax_number)
                            <p>
                                <span class="text-medium text-default">
                                    {{ trans('general.tax_number') }}:
                                </span>
                                {{ $document->contact_tax_number }}
                            </p>
                        @endif
                    @endif
                @stack('tax_number_input_end')

                @stack('phone_input_start')
                    @if (! $hideContactPhone)
                        @if ($document->contact_phone)
                            <p>
                                {{ $document->contact_phone }}
                            </p>
                        @endif
                    @endif
                @stack('phone_input_end')

                @stack('email_start')
                    @if (! $hideContactEmail)
                        <p class="small-text">
                            {{ $document->contact_email }}
                        </p>
                    @endif
                @stack('email_input_end')
            </div>
        </div>

        <div class="col-40">
            <div class="text p-index-right">
                @stack('order_number_input_start')
                    @if (! $hideOrderNumber)
                        @if ($document->order_number)
                            <p class="mb-0">
                                <span class="text-bold spacing">
                                    {{ trans($textOrderNumber) }}:
                                </span>

                                <span class="float-right spacing">
                                    {{ $document->order_number }}
                                </span>
                            </p>
                        @endif
                    @endif
                @stack('order_number_input_end')

                @stack('issued_at_input_start')
                    @if (! $hideIssuedAt)
                        <p class="mb-0">
                            <span class="text-bold spacing">
                                {{ trans($textIssuedAt) }}:
                            </span>

                            <span class="float-right spacing">
                                @date($document->issued_at)
                            </span>
                        </p>
                    @endif
                @stack('issued_at_input_end')

                @stack('due_at_input_start')
                    @if (! $hideDueAt)
                        <p class="mb-0">
                            <span class="text-bold spacing">
                                {{ trans($textDueAt) }}:
                            </span>

                            <span class="float-right spacing">
                                @date($document->due_at)
                            </span>
                        </p>
                    @endif
                @stack('due_at_input_end')

                @foreach ($document->totals_sorted as $total)
                    @if ($total->code == 'total')
                        <p class="mb-0">
                            <span class="text-bold spacing">
                                {{ trans($total->name) }}:
                            </span>

                            <span class="float-right spacing">
                                @money($total->amount - $document->paid, $document->currency_code, true)
                            </span>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @if (! $hideItems)
        <div class="row">
            <div class="col-100">
                <div class="text extra-spacing">
                    <table class="c-lines">
                        <thead>
                            <tr>
                                @stack('name_th_start')
                                    @if (! $hideItems || (! $hideName && ! $hideDescription))
                                        <th class="item text text-bold text-alignment-left text-left">
                                            {{ (trans_choice($textItems, 2) != $textItems) ? trans_choice($textItems, 2) : trans($textItems) }}
                                        </th>
                                    @endif
                                @stack('name_th_end')

                                @stack('quantity_th_start')
                                    @if (! $hideQuantity)
                                        <th class="quantity text text-bold text-alignment-right text-right">
                                            {{ trans($textQuantity) }}
                                        </th>
                                    @endif
                                @stack('quantity_th_end')

                                @stack('price_th_start')
                                    @if (! $hidePrice)
                                        <th class="price text text-bold text-alignment-right text-right">
                                            {{ trans($textPrice) }}
                                        </th>
                                    @endif
                                @stack('price_th_end')

                                @if (! $hideDiscount)
                                    @if (in_array(setting('localisation.discount_location', 'total'), ['item', 'both']))
                                        @stack('discount_td_start')
                                            <th class="discount text text-bold text-alignment-right text-right">
                                                {{ trans('invoices.discount') }}
                                            </th>
                                        @stack('discount_td_end')
                                    @endif
                                @endif

                                @stack('total_th_start')
                                    @if (! $hideAmount)
                                        <th class="total text text-bold text-alignment-right text-right">
                                            {{ trans($textAmount) }}
                                        </th>
                                    @endif
                                @stack('total_th_end')
                            </tr>
                        </thead>

                        <tbody>
                            @if ($document->items->count())
                                @foreach($document->items as $item)
                                    <x-documents.template.line-item
                                        type="{{ $type }}"
                                        :item="$item"
                                        :document="$document"
                                        hide-items="{{ $hideItems }}"
                                        hide-name="{{ $hideName }}"
                                        hide-description="{{ $hideDescription }}"
                                        hide-quantity="{{ $hideQuantity }}"
                                        hide-price="{{ $hidePrice }}"
                                        hide-discount="{{ $hideDiscount }}"
                                        hide-amount="{{ $hideAmount }}"
                                    />
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text empty-items">
                                        {{ trans('documents.empty_items') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-4 clearfix">
        <div class="col-60">
            <div class="text p-index-right">
                @stack('notes_input_start')
                    @if ($hideNote)
                        @if ($document->notes)
                            <strong>
                                {{ trans_choice('general.notes', 2) }}
                            </strong>

                            {!! nl2br($document->notes) !!}
                        @endif
                    @endif
                @stack('notes_input_end')
            </div>
        </div>

        <div class="col-40 float-right text-right">
            @foreach ($document->totals_sorted as $total)
                @if ($total->code != 'total')
                    @stack($total->code . '_total_tr_start')
                    <div class="text border-bottom-dashed py-1">
                        <strong class="float-left text-bold">
                            {{ trans($total->title) }}:
                        </strong>

                        <span>
                            @money($total->amount, $document->currency_code, true)
                        </span>
                    </div>
                    @stack($total->code . '_total_tr_end')
                @else
                    @if ($document->paid)
                        @stack('paid_total_tr_start')
                        <div class="text border-bottom-dashed py-1">
                            <span class="float-left text-bold">
                                {{ trans('invoices.paid') }}:
                            </span>

                            <span>
                                - @money($document->paid, $document->currency_code, true)
                            </span>
                        </div>
                        @stack('paid_total_tr_end')
                    @endif

                    @stack('grand_total_tr_start')
                    <div class="text border-bottom-dashed py-1">
                        <span class="float-left text-bold">
                            {{ trans($total->name) }}:
                        </span>

                        <span>
                            @money($document->amount_due, $document->currency_code, true)
                        </span>
                    </div>
                    @stack('grand_total_tr_end')
                @endif
            @endforeach
        </div>
    </div>
    <div style="float:right; margin-top:10px">
        @if($stamp)
            <img src="{{$stamp}}" alt="">
        @endif
    </div>
    @if (! $hideFooter)
        @if ($document->footer)
            <div class="row mt-1">
                <div class="col-100">
                    <div class="text company">
                        <strong>
                            {!! nl2br($document->footer) !!}
                        </strong>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <div style="clear: both"></div>

</div>
