<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and 'php-payment-gateway' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */

Route::admin('php-payment-gateway', function () {
    Route::get('/', 'Main@index');
});
