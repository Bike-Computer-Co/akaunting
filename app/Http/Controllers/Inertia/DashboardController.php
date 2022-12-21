<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
