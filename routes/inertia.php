<?php

use App\Http\Controllers\Inertia\CompanyController;
use App\Http\Controllers\Inertia\StripePlanController;
use App\Http\Controllers\Inertia\UserController;

Route::redirect('/', '/users');
Route::resource('users', UserController::class)->only('index', 'create', 'store', 'show');
Route::resource('companies', CompanyController::class)->only('update');
Route::resource('stripe-plans', StripePlanController::class)->only('index', 'store', 'destroy');
