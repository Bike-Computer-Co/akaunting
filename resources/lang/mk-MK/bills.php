<?php

return [

    'bill_number'           => 'Број на сметка',
    'bill_date'             => 'Датум на сметка',
    'total_price'           => 'Вкупна цена',
    'due_date'              => 'Рок на доспевање',
    'order_number'          => 'Број на нарачка',
    'bill_from'             => 'Сметка од',

    'quantity'              => 'Количина',
    'price'                 => 'Цена',
    'sub_total'             => 'Меѓузбир/сума',
    'discount'              => 'Попуст',
    'item_discount'         => 'Попуст на линија/производ',
    'tax_total'             => 'Вкупен данок',
    'total'                 => 'Вкупна сума',

    'item_name'             => 'Име на производ|Имиња на производ',

    'show_discount'         => ':discount% Попуст',
    'add_discount'          => 'Вклучи попуст/Пресметај попуст',
    'discount_desc'         => 'на сумата/меѓузбирот',

    'payment_due'           => 'Доспев на исплата',
    'amount_due'            => 'Доспев на износ',
    'paid'                  => 'Платено',
    'histories'             => 'Изводи',
    'payments'              => 'Плаќања',
    'add_payment'           => 'Додади плаќање',
    'mark_paid'             => 'Означи како платено',
    'mark_received'         => 'Означи како примено',
    'mark_cancelled'        => 'Означи како откажано',
    'download_pdf'          => 'Преземи PDF',
    'send_mail'             => 'Испрати емаил',
    'create_bill'           => 'Креирај сметка',
    'receive_bill'          => 'Добиј (потврдна) сметка',
    'make_payment'          => 'Направи исплата',

    'messages' => [
        'draft'             => 'Ова е <b>НЕИСПРАТЕНА</b> сметка и ќе биде заведена во статистиката откако ќе пристигне.',

        'status' => [
            'created'       => 'Креирано на :date',
            'receive' => [
                'draft'     => 'Неиспратено',
                'received'  => 'Примено/добиено на :date',
            ],
            'paid' => [
                'await'     => 'Наплата во исчекување',
            ],
        ],
    ],

];
