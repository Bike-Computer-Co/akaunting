<?php

Route::middleware(['bindings'])->group(function (){
    Route::prefix('/auth')->group(function (){
        Route::post('/login', 'Auth@login');
    });

    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/companies', 'Company@index');

        Route::middleware('company.identify')->prefix('/{company_id}')->group(function (){
            Route::get('/transactions/create', 'Transaction@create');
            Route::post('/transactions', 'Transaction@store');
        });
    });

});
