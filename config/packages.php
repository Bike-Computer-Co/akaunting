<?php
return [
    [
        'name' => 'SIMPLE START',
        'monthly_price' => 0,
        'monthly_promo_price' => 0,
        'monthly_promo_duration' => 0,
        'yearly_price' => 0,
        'yearly_promo_price' => 0,
        'yearly_promo_duration' => 0,
        'trial_days' => 0,
        'featured' => false,
        'features' => [
            'mk' => [
                'Персонализирани фактури',
                'Трошоци',
                'Обврски',
                'Трансакции',
                'iOS и Android пристап',
                'Основни Финансиски извештаи',
            ],
            'en' => [
                'Personalized invoices',
                'Expenses',
                'Payables',
                'Transactions',
                'iOS and Android access',
                'Basic Financial reports',
            ],
        ],
        'feature_keys'=>[],
        'support' => [
            'Email'
        ]
    ],
    [
        'name' => 'STARTER',
        'monthly_price' => 14.00,
        'monthly_promo_price' => 4.00,
        'monthly_promo_duration' => 3,
        'monthly_stripe_id' => env('STARTER_MONTHLY_STRIPE_ID'),
        'yearly_price' => 168.00,
        'yearly_promo_price' => 110.00,
        'yearly_promo_duration' => 1,
        'yearly_stripe_id' => env('STARTER_YEARLY_STRIPE_ID'),
        'trial_days' => 30,
        'featured' => false,
        'features' => [
            'mk' => [
                'Персонализирани фактури',
                'Трошоци',
                'Обврски',
                'Трансакции',
                'iOS и Android пристап',
                'Основни Финансиски извештаи',
                'Автоматски испраќајте потсетници за задоцнето плаќање',
                'Повторливи фактури',
                'Поканете го вашиот сметководител'
            ],
            'en' => [
                'Personalized invoices',
                'Expenses',
                'Payables',
                'Transactions',
                'iOS and Android access',
                'Basic Financial reports',
                'Automatically send late payment reminders',
                'Recurring invoices',
                'Invite your accountant'
            ],
        ],
        'feature_keys'=>['invite_accountant', 'recurring_invoices', 'remind'],

        'support' => [
            'Email',
            'Chat'
        ]
    ],
    [
        'name' => 'ADVANCE',
        'monthly_price' => 23.00,
        'monthly_promo_price' => 6.99,
        'monthly_promo_duration' => 3,
        'monthly_stripe_id' => env('ADVANCE_MONTHLY_STRIPE_ID'),
        'yearly_price' => 276.00,
        'yearly_promo_price' => 181.99,
        'yearly_promo_duration' => 1,
        'yearly_stripe_id' => env('ADVANCE_YEARLY_STRIPE_ID'),
        'trial_days' => 30,
        'featured' => true,
        'features' => [
            'mk' => [
                'Персонализирани фактури',
                'Трошоци',
                'Обврски',
                'Трансакции',
                'iOS и Android пристап',
                'Основни Финансиски извештаи',
                'Автоматски испраќајте потсетници за задоцнето плаќање',
                'Повторливи фактури',
                'Поканете го вашиот сметководител',
                'Управување со платен список',
                'Team Flex Payments (наскоро)'
            ],
            'en' => [
                'Personalized invoices',
                'Expenses',
                'Payables',
                'Transactions',
                'iOS and Android access',
                'Basic Financial reports',
                'Automatically send late payment reminders',
                'Recurring invoices',
                'Invite your accountant',
                'Payroll Management',
                'Team Flex Payments (soon)'
            ],
        ],
        'feature_keys'=>['invite_accountant', 'recurring_invoices', 'remind'],

        'support' => [
            'Email',
            'Chat'
        ]
    ],
    [
        'name' => 'PROFESSIONAL',
        'monthly_price' => 32.00,
        'monthly_promo_price' => 9.00,
        'monthly_promo_duration' => 3,
        'monthly_stripe_id' => env('PROFESSIONAL_MONTHLY_STRIPE_ID'),
        'yearly_price' => 384.00,
        'yearly_promo_price' => 251.00,
        'yearly_promo_duration' => 1,
        'yearly_stripe_id' => env('PROFESSIONAL_YEARLY_STRIPE_ID'),
        'trial_days' => 30,
        'featured' => false,
        'features' => [
            'mk' => [
                'Персонализирани фактури',
                'Трошоци',
                'Обврски',
                'Трансакции',
                'iOS и Android пристап',
                'Основни Финансиски извештаи',
                'Автоматски испраќајте потсетници за задоцнето плаќање',
                'Повторливи фактури',
                'Поканете го вашиот сметководител',
                'Управување со платен список',
                'Team Flex Payments (наскоро)',
                'Примајте уплата со кредитна картичка',
                'Дигитално потпишување на документи',
                'Напредни Финансиски извештаи'
            ],
            'en' => [
                'Personalized invoices',
                'Expenses',
                'Payables',
                'Transactions',
                'iOS and Android access',
                'Basic Financial reports',
                'Automatically send late payment reminders',
                'Recurring invoices',
                'Invite your accountant',
                'Payroll Management',
                'Team Flex Payments (soon)',
                'Receive payment by credit card',
                'Digital signing of documents',
                'Advanced Financial reports'
            ],
        ],
        'feature_keys'=>['invite_accountant', 'recurring_invoices', 'remind'],
        'support' => [
            'Email',
            'Chat',
            'Voice'
        ]
    ]


];
