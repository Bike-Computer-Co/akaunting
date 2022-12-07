<?php

use App\Http\Controllers\Inertia\UserController;

Route::name('super.')->group(function () {
    Route::resource('users', UserController::class)->only('index', 'create', 'store', 'show');
});
