<?php

use Illuminate\Support\Facades\Route;

/**
 * 'portal' middleware and 'portal/nlb-bank' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */

Route::portal('nlb-bank', function () {
    // Route::get('invoices/{invoice}', 'Main@show')->name('invoices.show');
    // Route::post('invoices/{invoice}/confirm', 'Main@confirm')->name('invoices.confirm');

    Route::get('invoices/{invoice}', 'Payment@show')->name('invoices.show');
    Route::post('invoices/{invoice}/confirm', 'Payment@confirm')->name('invoices.confirm');
    Route::get('invoices/{invoice}/return', 'Payment@return')->name('invoices.return');
    Route::get('invoices/{invoice}/cancel', 'Payment@cancel')->name('invoices.cancel');

});
