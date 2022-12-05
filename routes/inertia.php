<?php

use App\Http\Controllers\Inertia\UserController;

// TODO: PROTECT THE ROUTES ONLY FOR SUPER ADMIN
Route::name('super.')->group(function () {
    Route::resource('users', UserController::class)->only('index', 'create', 'store');
});
