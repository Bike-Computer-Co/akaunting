<?php
Route::get('/redirect', 'BillingController@redirect')->name('billing.redirect');
Route::get('/subscription', "BillingController@subscription")->name('billing.subscription');
Route::post('/subscribe', "BillingController@subscribe")->name('billing.subscribe');
//    Route::patch('/swap', "BillingController@swap")->name('billing.swap');
Route::patch('/cancel', "BillingController@cancel")->name('billing.cancel');
Route::patch('/resume', "BillingController@resume")->name('billing.resume');
