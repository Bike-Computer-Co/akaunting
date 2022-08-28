<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function redirect(Request $request)
    {
        $request->user()->createOrGetStripeCustomer();
        return $request->user()->redirectToBillingPortal(route('dashboard'));
    }
}
