<?php

return [

    'invoice_new_customer' => [
        'subject'       => '{invoice_number} фактура направена.',
        'body'          => 'Драг/а {customer_name},<br /><br />Ја спремавме следната фактура за Вас: <strong>{invoice_number}</strong>.<br /><br />Можете да ги прегледате деталите на фактурата и да продолжите со плаќање на следниот линк: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />Слободно контактирајте не за било какви прашања.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_remind_customer' => [
        'subject'       => 'Задоцнување на фактурата {invoice_number}',
        'body'          => 'Драг/а {customer_name},<br /><br />Оваа е потсетник за задоцнување: <strong>{invoice_number}</strong> фактура.<br /><br />Вкупно {invoice_total} требаше да се плати <strong>{invoice_due_date}</strong>.<br /><br />Можете да ги прегледате деталите на фактурата и да продолжите со плаќање на следниот линк: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_remind_admin' => [
        'subject'       => 'Задоцнување на фактура {invoice_number}',
        'body'          => 'Здраво, <br /><br />{customer_name} доби потсетник за задоцнување за <strong>{invoice_number}</strong> фактура.<br /><br />Вкупно {invoice_total} и требаше да се плати до <strong>{invoice_due_date}</strong>.<br /><br />Можете да ги прегледате деталите на фактурата на следниот линк: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_recur_customer' => [
        'subject'       => '{invoice_number} периодична фактура креирана',
        'body'          => 'Драг/а {customer_name},<br /><br />Врз основа на вашиот периодичен круг, ја спремавме следната фактура за вас: <strong>{invoice_number}</strong>.<br /><br />Можете да ги прегледате деталите на фактурата и да продолжите со плаќање на следниот линк: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />Слободно контактирајте не за било какви прашања.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_recur_admin' => [
        'subject'       => '{invoice_number} периодична фактура креирана',
        'body'          => 'Здраво, <br /><br />Базирано на периодичниот круг на {customer_name}, фактурата <strong>{invoice_number}</strong> беше автоматски создадена.<br /><br />Можете да ги прегледате деталите на фактурата на следниот линк: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_payment_customer' => [
        'subject'       => 'Фактурата {invoice_number} е платена',
        'body'          => 'Драг/а {customer_name},<br /><br />Ви благодариме за плаќањето. Погледнете ги деталите подолу:<br /><br />-------------------------------------------------<br />Сума: <strong>{transaction_total}</strong><br />Датум: <strong>{transaction_paid_date}</strong><br />Број на фактура: <strong>{invoice_number}</strong><br />-------------------------------------------------<br /><br />Можете да ги погледнете деталите за фактурата на следниот линк: <a href="{invoice_guest_link}">{invoice_number}</a>.<br /><br />Слободно контактирајте не за било какви прашања.<br /><br />Со почит,<br />{company_name}',
    ],

    'invoice_payment_admin' => [
        'subject'       => 'Фактурата {invoice_number} е платена',
        'body'          => 'Здраво,<br /><br />{customer_name} сними плаќање за фактура <strong>{invoice_number}</strong>.<br /><br />Можете да ги погледнете деталите за фактурата на следниот линк: <a href="{invoice_admin_link}">{invoice_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'bill_remind_admin' => [
        'subject'       => 'Потсетник за сметка {bill_number}',
        'body'          => 'Здраво,<br /><br />Оваа е потсетник за <strong>{bill_number}</strong> сметка до {vendor_name}.<br /><br />Вкупно {bill_total} и е за <strong>{bill_due_date}</strong>.<br /><br />Можете да ги погледнете деталите за сметката на следниот линк: <a href="{bill_admin_link}">{bill_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'bill_recur_admin' => [
        'subject'       => '{bill_number} периодична сметка создадена',
        'body'          => 'Здраво,<br /><br />Базирано на {vendor_name} периодичен круг, <strong>{bill_number}</strong> сметка беше автоматски создадена.<br /><br />Можете да ги погледнете деталите за сметката на следниот линк: <a href="{bill_admin_link}">{bill_number}</a>.<br /><br />Со почит,<br />{company_name}',
    ],

    'payment_received_customer' => [
        'subject'       => 'Вашата сметка од {company_name}',
        'body'          => 'Драг\а {contact_name},<br /><br />Ви благодариме на вашето плаќање. <br /><br />Деталите за плаќањето можете да ги видите на следниот линк: <a href="{payment_guest_link}">{payment_date}</a>.<br /><br />Слободно контактирајте не за било какви прашања.<br /><br />Со почит,<br />{company_name}',
    ],

    'payment_made_vendor' => [
        'subject'       => 'Payment made by {company_name}',
        'body'          => 'Драг\а {contact_name},<br /><br />Ја направивме следнава наплата. <br /><br />Деталите за плаќањето можете да ги видите на следниот линк: <a href="{payment_guest_link}">{payment_date}</a>.<br /><br />Слободно контактирајте не за било какви прашања.<br /><br />Со почит,<br />{company_name}',
    ],
];
