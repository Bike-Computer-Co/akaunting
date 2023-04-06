<?php

namespace App\Http\Controllers\MobileApp;

use App\Traits\Transactions;
use Illuminate\Routing\Controller;

class Company extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $companies  = $user
            ->companies()
            ->get()
            ->map(fn($company)=>
            $company->only(['id', 'name', 'account', 'currency', 'country', 'expense_category', 'income_category']),
            );
        return response()->json($companies);
    }
}
