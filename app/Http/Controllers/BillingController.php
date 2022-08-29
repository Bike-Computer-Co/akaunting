<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function redirect(Request $request)
    {
        $company = company();
        $company->createOrGetStripeCustomer();
        return $company->redirectToBillingPortal(route('dashboard'));
    }
}
