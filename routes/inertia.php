<?php

use App\Http\Controllers\Inertia\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index']);
