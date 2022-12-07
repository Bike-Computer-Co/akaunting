<?php

return [

    // TODO:

    'company' => [
        'name' => 'Име',
        'email' => 'Е-пошта',
        'phone' => 'Телефон',
        'address' => 'Адреса',
        'logo' => 'Лого',
        'signature' => 'Потпис',
        'stamp' => 'Печат',
    ],
    'localisation' => [
        'tab' => 'Локализација',
        'financial_start' => 'Годината започнува на',
        'financial_denote' => [
            'title' => 'Означување на финансиска година',
            'begins' => 'Годината во која почнува',
            'ends' => 'Годината во која завршува',
        ],
        'preferred_date' => 'Посакуван формат на датум',

        'date' => [
            'format' => 'Формат на датум',
            'separator' => 'Текст разделник',
            'dash' => 'Црта(-)',
            'dot' => 'Точка (.)',
            'comma' => 'Запирка (,)',
            'slash' => 'Коса црта (/)',
            'space' => 'Празно место ( )',
        ],
        'timezone' => 'Временска зона',
        'percent' => [
            'title' => 'Процент (%) Позиција',
            'before' => 'Пред број',
            'after' => 'После број',
        ],
        'discount_location' => [
            'name' => 'Место за попуст',
            'item' => 'На ставка',
            'total' => 'На вкупно',
            'both' => 'И на ставка и на вкупно',
        ],
        'form_description' => [
            'fiscal' => 'Постави го финансискиот период кој вашата компанија го користи за даноци и извештаи.',
            'date' => 'Одбери го форматот на датум кој сакате да го користите секаде.',
            'other' => 'Одбери каде ќе се прикажува знакот за процент за даноци. Исто може да овозможите попусти на одредени ставки и на цела фактура или сметка.',
        ],
    ],
    'invoice' => [
        'tab' => 'Фактура',
        'prefix' => 'Префикс на број',
        'digit' => 'Цифрен број',
        'next' => 'Следен број',
        'logo' => 'Лого',
        'custom' => 'Прилагодео',
        'item_name' => 'Наслов за ставка',
        'item' => 'Ставки',
        'product' => 'Продукти',
        'service' => 'Услуги',
        'price_name' => 'Наслов за цена',
        'price' => 'Цена',
        'rate' => 'Однос',
        'default' => 'Стандардно',
        'quantity_name' => 'Наслов за квантитет',
        'quantity' => 'Квантитет',
    ],
    'default' => [
        'tab' => 'Стандардно',
        'account' => 'Основна сметка',
        'currency' => 'Основна валута',
        'tax' => 'Основна стапка на данок',
        'payment' => 'Основен начин на плаќање',
        'language' => 'Поставен јазик за сајт',

        'description' => 'Стандардна корисничка сметка, валута, јазик на Вашата компанија',
        'search_keywords' => 'account, currency, language, tax, payment, method, pagination',
        'list_limit' => 'ставки на страница',
        'use_gravatar' => 'Користи Граватар',
        'income_category' => 'Категорија за Приход ',
        'expense_category' => 'Категорија за Трошок',

        'form_description' => [
            'general' => 'Одбери ја стандардната корисничка сметка, данок и платежен метод за да започнете. Корисничката табла и Извештаите се прикажани под стандардната валута.',
            'category' => 'Одбери го стандардните категории за Вашата компанија.',
            'other' => 'Прилагоди ги стандардните опции нза јазикот на вашата компанија и работењето со страници. ',
        ],

    ],
    'email' => [
        'protocol' => 'Протокол',
        'php' => 'PHP Маил',
        'smtp' => [
            'name' => 'SMTP',
            'host' => 'SMTP Host',
            'port' => 'SMTP Port',
            'username' => 'SMTP корисничко име',
            'password' => 'SMTP лозинка',
            'encryption' => 'SMTP безбедност',
            'none' => 'Ништо',
        ],
        'sendmail' => 'Sendmail',
        'sendmail_path' => 'Патека до праќач на писма',
        'log' => 'Лог од е-маил пораки',
        'email_templates' => 'Емаил шаблони',

        'description' => 'Промени го протоколот за испраќање',
        'search_keywords' => 'email, send, protocol, smtp, host, password',

        'email_service' => 'Емаил сервис',

        'form_description' => [
            'general' => 'Send regular emails to your team and contacts. You can set the protocol and SMTP settings.',
        ],

        'templates' => [
            'description' => 'Change the email templates',
            'search_keywords' => 'email, template, subject, body, tag',
            'subject' => 'Subject',
            'body' => 'Body',
            'tags' => '<strong>Available Tags:</strong> :tag_list',
            'invoice_new_customer' => 'New Invoice Template (sent to customer)',
            'invoice_remind_customer' => 'Invoice Reminder Template (sent to customer)',
            'invoice_remind_admin' => 'Invoice Reminder Template (sent to admin)',
            'invoice_recur_customer' => 'Invoice Recurring Template (sent to customer)',
            'invoice_recur_admin' => 'Invoice Recurring Template (sent to admin)',
            'invoice_view_admin' => 'Invoice View Template (sent to admin)',
            'invoice_payment_customer' => 'Invoice Payment Receipt Template (sent to customer)',
            'invoice_payment_admin' => 'Invoice Payment Received Template (sent to admin)',
            'bill_remind_admin' => 'Bill Reminder Template (sent to admin)',
            'bill_recur_admin' => 'Bill Recurring Template (sent to admin)',
            'payment_received_customer' => 'Payment Receipt Template (sent to customer)',
            'payment_made_vendor' => 'Payment Made Template (sent to vendor)',
        ],
    ],
    'scheduling' => [
        'tab' => 'Распоред',
        'send_invoice' => 'Испрати потсетник за пораки',
        'invoice_days' => 'Испрати после денови на доспевање',
        'send_bill' => 'Испрати потсетник за сметки',
        'bill_days' => 'Испрати пред денови на доспевање',
        'cron_command' => 'Cron Command',
        'schedule_time' => 'Како да се изврши',
        'send_item_reminder' => 'Send Item Reminder',
        'item_stocks' => 'Send When Item Stock',
        'name' => 'Закажување',
        'description' => 'Automatic reminders and command for recurring',
        'search_keywords' => 'automatic, reminder, recurring, cron, command',
        'command' => 'Command',

        'form_description' => [
            'invoice' => 'Овозможи или оневозможи, или постави потсетници за вашита фактури кога доспеваат.',
            'bill' => 'Овозможи или оневозможи, или постави потсетници за вашите сметки пред да доспеат.',
            'cron' => 'Copy the cron command that your server should run. Set the time to trigger the event.',
        ],
    ],
    'appearance' => [
        'tab' => 'Изглед',
        'theme' => 'Тема',
        'light' => 'Светло',
        'dark' => 'Темно',
        'list_limit' => 'Записи по страна',
        'use_gravatar' => 'Користи Меме',
    ],
    'system' => [
        'tab' => 'Систем',
        'session' => [
            'lifetime' => 'Време на активна сесија (Минути)',
            'handler' => 'Ракувач со сесија',
            'file' => 'Фајл',
            'database' => 'Датабаза',
        ],
        'file_size' => 'Максимална големина на фајл (MB)',
        'file_types' => 'Дозволени типови на фајлови',
    ],

];
