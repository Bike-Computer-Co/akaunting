<?php

return [

    'payment_received'      => 'Плаќањето е пристигнато',
    'payment_made'          => 'Плаќањето е направено',
    'paid_by'               => 'Платено од',
    'paid_to'               => 'Платено на',
    'related_invoice'       => 'Соодветна фактура',
    'related_bill'          => 'Соодветна сметка',
    'recurring_income'      => 'Периодично примање',
    'recurring_expense'     => 'Периодичен трошок',

    'form_description' => [
        'general'           => 'Тука може да ги внесете информациите за трансакцијата, на пример: датум, сума, акаунт, опис и останато.',
        'assign_income'     => 'Селектирајте категорија и клиент за да имате подетален записник.',
        'assign_expense'    => 'Селектирајте категорија и трговец за да имате подетален записник.',
        'other'             => 'Внесете референца за да ја зачувате трансакцијата во вашиот записник.',
    ],

    'slider' => [
        'create'            => ':user направи трансакција на :date',
        'attachments'       => 'Симнете ги фајловите прикачени на дадената трансакција',
        'create_recurring'  => ':user направи периодичен шаблон на :date',
        'schedule'          => 'Повторување на :interval :frequency од :date',
        'children'          => ':count трансакции направени автоматски',
        'transfer_headline' => 'Од :from_account на :to_account',
        'transfer_desc'     => 'Трансферот е направен на :date.',
    ],

    'share' => [
        'income' => [
            'show_link'     => 'Your customer can view the transaction at this link',
            'copy_link'     => 'Copy the link and share it with your customer.',
        ],

        'expense' => [
            'show_link'     => 'Your vendor can view the transaction at this link',
            'copy_link'     => 'Copy the link and share it with your vendor.',
        ],
    ],

    'sticky' => [
        'description'       => 'You are previewing how your customer will see the web version of your payment.',
    ],

];
