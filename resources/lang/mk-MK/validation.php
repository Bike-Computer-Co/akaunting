<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute мора да се прифати.',
    'active_url' => ':attribute не е валидна URL-адреса.',
    'after' => ':attribute мора да биде датум по :date.',
    'after_or_equal' => ':attribute мора да биде датум по или еднаков од :date.',
    'alpha' => ':attribute може да содржи само букви.',
    'alpha_dash' => ':attribute може да содржи само букви, бројки и цртички.',
    'alpha_num' => ':attribute може да содржи само букви и бројки.',
    'array' => ':attribute мора да биде низа.',
    'before' => ':attribute мора да биде датум пред :date.',
    'before_or_equal' => ':attribute  мора да биде датум пред или еднаков од :date.',
    'between' => [
        'numeric' => ':attribute мора да биде помеѓу :min и :max.',
        'file' => ':attribute мора да биде помеѓу :min и :max килобајти.',
        'string' => ':attribute мора да биде помеѓу :min и :max карактерите.',
        'array' => 'The :attribute мора да биде помеѓу :min и :max предметите.',
    ],
    'boolean' => ':attribute полето мора да биде точно или неточно.',
    'confirmed' => ':attribute потврдата не се совпаѓа.',
    'date' => ':attribute не е валиден датум.',
    'date_format' => ':attribute не одговара на форматот :format.',
    'different' => ':attribute и :other мора да бидат <strong>различни</strong>.',
    'digits' => ':attribute мора да бидат :digits цифри.',
    'digits_between' => ':attribute мора да биде помеѓу :min и :max цифрите.',
    'dimensions' => ':attribute има невалидни димензии на сликата.',
    'distinct' => ':attribute полето има дупликат вредност.',
    'email' => ':attribute мора да биде валидна <strong>адреса на е-пошта</strong>.',
    'ends_with' => ':attribute мора да заврши со едно од следниве: :values',
    'exists' => 'Избраниот :attribute е невалиден.',
    'file' => ':attribute мора да биде <strong>датотека</strong>.',
    'filled' => ':attribute полето мора да има <strong>вредност</strong>.',
    'image' => ':attribute мора да биде <strong>слика</strong>.',
    'in' => 'Избраниот :attribute е невалиден.',
    'in_array' => ':attribute полето не постои во :other.',
    'integer' => ':attribute мора да биде <strong>цел број</strong>.',
    'ip' => ':attribute мора да биде валидна IP адреса.',
    'json' => ':attribute мора да биде валидна JSON низа',
    'max' => [
        'numeric' => ':attribute не може да биде поголем од :max.',
        'file' => ':attribute не може да биде поголем од :max килобајти.',
        'string' => ':attribute не може да биде поголем од :max карактерот.',
        'array' => 'The :attribute не може да има повеќе од :max предмети.',
    ],
    'mimes' => ':attribute мора да биде датотека од типот: :values.',
    'mimetypes' => ':attribute мора да биде датотека од типот: :values.',
    'min' => [
        'numeric' => ':attribute мора да биде барем :min.',
        'file' => ':attribute мора да биде барем :min килобајти.',
        'string' => ':attribute мора да има барем :min карактери.',
        'array' => 'The :attribute мора да има барем :min предмети.',
    ],
    'not_in' => 'Избраниот :attribute е невалиден.',
    'numeric' => ':attribute мора да биде бројка.',
    'present' => ':attribute полето мора да биде <strong>присутно</strong>.',
    'regex' => ':attribute форматот е <strong>невалиден</strong>.',
    'required' => ':attribute полето е <strong>потребен</strong>.',
    'required_if' => ':attribute полето е потребен кога :other е :value.',
    'required_unless' => ':attribute полето е потребен освен ако :other е во :values.',
    'required_with' => ':attribute полето е потребен кога :values е присутен.',
    'required_with_all' => ':attribute полето е потребен кога :values е присутен.',
    'required_without' => ':attribute полето е потребен кога :values не е присутен.',
    'required_without_all' => ':attribute полето е потребен кога ниту еден од :values се присутни.',
    'same' => ' :attribute и :other мора да одговарат.',
    'size' => [
        'numeric' => ':attribute мора да биде :size.',
        'file' => ':attribute мора да биде :size килобајти.',
        'string' => ':attribute мора да има <strong>:size карактери</strong>.',
        'array' => ' :attribute мора да содржи :size предмети.',
    ],
    'string' => ':attribute мора да биде <strong>низа од знаци</strong>.',
    'timezone' => ':attribute мора да биде валидна зона.',
    'unique' => ':attribute веќе бил <strong>преземен</strong>.',
    'uploaded' => ':attribute <strong>не успеа</strong> да се подига',
    'url' => ':attribute форматот е <strong>невалиден</strong>.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'прилагодена-порака',
        ],
        'invalid_currency' => ':attribute кодот е невалиден.',
        'invalid_amount' => 'износот :attribute е невалиден.',
        'invalid_extension' => 'наставката на датотеката е невалидна.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
