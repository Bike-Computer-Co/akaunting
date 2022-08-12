<?php
Route::portal('nlb-bank', function () {

    Route::post('invoices/{invoice}/callback', 'Payment@callback')->name('invoices.callback');

}, ['middleware' => 'guest']);
