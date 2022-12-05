<?php

namespace App\Http\Controllers\Inertia;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends BaseController
{
    public function index(): Response
    {
        return Inertia::render('Dashboard');
    }
}
