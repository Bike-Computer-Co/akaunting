<?php

return [

    'invoice_number' => 'Број на фактура',
    'invoice_date' => 'Датум на фактура',
    'total_price' => 'Вкупна цена',
    'due_date' => 'Краен рок',
    'order_number' => 'Број на нарачка',
    'bill_to' => 'Клиент',

    'quantity' => 'Квантитет',
    'price' => 'Цена',
    'sub_total' => 'Вкупно',
    'discount' => 'Попуст',
    'item_discount' => 'Попуст на линија',
    'tax_total' => 'Вкупен данок',
    'total' => 'Вкупно',

    'item_name' => 'Име на ставка|Имиња на ставки',

    'show_discount' => ':discount% Discount',
    'add_discount' => 'Додадете попуст',
    'discount_desc' => 'of вкупно',

    'payment_due' => 'Доспеано плаќање',
    'paid' => 'Платено',
    'histories' => 'Истории',
    'payments' => 'Плаќања',
    'add_payment' => 'Додадете плаќање',
    'mark_paid' => 'Означи платено',
    'mark_sent' => 'Означи платено',
    'mark_viewed' => 'Означи прегледано',
    'mark_cancelled' => 'Означи откажано',
    'download_pdf' => 'Преземи PDF',
    'send_mail' => 'Прати маил',
    'all_invoices' => 'Најавете се за да ги видите сите фактури',
    'create_invoice' => 'Креирај фактура',
    'send_invoice' => 'Прати фактура',
    'get_paid' => 'Земи средства',
    'accept_payments' => 'Прифатете онлајн плаќања',
    'payment_received' => 'Примена уплата',

    'form_description' => [
        'billing' => '(превод) Billing details appear in your invoice. Invoice Date is used in the dashboard and reports. Select the date you expect to get paid as the Due Date.',
    ],
    'messages' => [
        'email_required' => 'Нема адреса на е-пошта за овој клиент!',
        'draft' => 'Ова е <b>НАЦРТ</b> фактура и ќе се одрази на графиконите откако ќе биде испратена.',

        'status' => [
            'created' => 'Создаден на :date',
            'viewed' => 'Прегледано',
            'send' => [
                'draft' => 'Не е испратено',
                'sent' => 'Испратено на :date',
            ],
            'paid' => [
                'await' => 'Чекај исплата',
            ],
        ],
    ],

    'slider' => [
        'create' => ':user ја креираше оваа фактура на :date',
        'create_recurring' => ':user го креираше овој повторувачки шаблон на :date',
        'schedule' => 'Повтори секој :interval :frequency се до :date',
        'children' => ':count фактури беа успешно креирани',
    ],

    'share' => [
        'show_link' => 'Вашиот клиент може да ја види оваа фактуран на следниот линк',
        'copy_link' => 'Копирај го линкот и сподели го со вашиот клиент',
        'success_message' => 'Линкот е успешно копиран',
    ],

];
