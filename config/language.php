<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable All Language Routes
    |--------------------------------------------------------------------------
    |
    | This option enable language route.
    |
    */
    'route' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable Language Home Route
    |--------------------------------------------------------------------------
    |
    | This option enable language route to set language and return
    | to url('/')
    |
    */
    'home' => false,

    /*
    |--------------------------------------------------------------------------
    | Add Language Code
    |--------------------------------------------------------------------------
    |
    | This option will add the language code to the redirected url
    |
    */
    'url' => false,

    /*
    |--------------------------------------------------------------------------
    | Set strategy
    |--------------------------------------------------------------------------
    |
    | This option will determine the strategy used to determine the back url.
    | It can be 'session' (default) or 'referer'
    |
    */
    'back' => 'session',

    /*
    |--------------------------------------------------------------------------
    | Carbon Language
    |--------------------------------------------------------------------------
    |
    | This option the language of carbon library.
    |
    */
    'carbon' => true,

    /*
    |--------------------------------------------------------------------------
    | Date Language
    |--------------------------------------------------------------------------
    |
    | This option the language of jenssegers/date library.
    |
    */
    'date' => false,

    /*
    |--------------------------------------------------------------------------
    | Auto Change Language
    |--------------------------------------------------------------------------
    |
    | This option allows to change website language to user's
    | browser language.
    |
    */
    'auto' => true,

    /*
    |--------------------------------------------------------------------------
    | Routes Prefix
    |--------------------------------------------------------------------------
    |
    | This option indicates the prefix for language routes.
    |
    */
    'prefix' => 'languages',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | This option indicates the middleware to change language.
    |
    */
    'middleware' => 'Akaunting\Language\Middleware\SetLocale',

    /*
    |--------------------------------------------------------------------------
    | Controller
    |--------------------------------------------------------------------------
    |
    | This option indicates the controller to be used.
    |
    */
    'controller' => 'Akaunting\Language\Controllers\Language',

    /*
    |--------------------------------------------------------------------------
    | Flags
    |--------------------------------------------------------------------------
    |
    | This option indicates the flags features.
    |
    */
    'flags' => ['width' => '22px', 'ul_class' => 'menu', 'li_class' => '', 'img_class' => ''],

    /*
    |--------------------------------------------------------------------------
    | Language code mode
    |--------------------------------------------------------------------------
    |
    | This option indicates the language code and name to be used, short/long
    | and english/native.
    | Short: language code (en)
    | Long: languagecode-COUNTRYCODE (en-GB)
    |
    */
    'mode' => ['code' => 'long', 'name' => 'native'],

    /*
    |--------------------------------------------------------------------------
    | Allowed languages
    |--------------------------------------------------------------------------
    |
    | This options indicates the language allowed languages.
    |
    */
    'allowed' => ['en-GB', 'mk-MK'],

    /*
    |--------------------------------------------------------------------------
    | All Languages
    |--------------------------------------------------------------------------
    |
    | This option indicates the language codes and names.
    |
    */
    'all' => [
        ['short' => 'en',       'long' => 'en-GB',      'english' => 'English (GB)',        'native' => 'English (GB)',                 'direction' => 'ltr'],
        ['short' => 'mk',       'long' => 'mk-MK',      'english' => 'Macedonian',          'native' => 'Македонски јазик',             'direction' => 'ltr'],
    ],

];
