<?php

use App\Http\Controllers\Inertia\CompanyController;
use App\Http\Controllers\Inertia\UserController;

Route::name('super.')->group(function () {
    Route::resource('users', UserController::class)->only('index', 'create', 'store', 'show');
    Route::resource('companies', CompanyController::class)->only('update');
});
