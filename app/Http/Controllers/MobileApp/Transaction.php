<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Resources\Banking\Transaction as Resource;
use App\Jobs\Banking\CreateTransaction;
use App\Models\Banking\Account;
use App\Models\Common\Contact;
use App\Models\Setting\Category;
use App\Traits\Transactions;
use App\Utilities\Modules;
use Illuminate\Routing\Controller;
use App\Http\Requests\Banking\Transaction as Request;
use App\Traits\Jobs;


class Transaction extends Controller
{
    use Jobs;
    use Transactions;

    public function create(): \Illuminate\Http\JsonResponse
    {

        return response()->json([
            'number'=> $this->getNextTransactionNumber(),
            'payment_methods' => Modules::getPaymentMethods(),
            'accounts'=> Account::enabled()->orderBy('name')
                ->get()
                ->map(fn($acc)=>$acc->only('id', 'title')),
            'categories' => Category::expense()->enabled()->orderBy('name')->get()->map(fn($cat)=> $cat->only('id', 'name')),
            'vendors' => Contact::vendor()
                ->enabled()->get()->map(fn($vendor)=> $vendor->only('id', 'name'))

        ]);
    }

    public function store(Request $request)
    {
        $transaction = $this->dispatch(new CreateTransaction($request));
        return response()->json(new Resource($transaction));
    }
}
