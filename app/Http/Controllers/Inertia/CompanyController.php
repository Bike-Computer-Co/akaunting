<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Common\Company;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function update(Company $company, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'accountant_price' => ['required', 'min:0', 'integer'],
            'lawyer_price' => ['required', 'min:0', 'integer'],
            'comment' => ['nullable'],
        ]);

        $company->fill($validated);
        $company->save();

        return back()->with('success', 'Успешно додадовте цени за сметководител и адвокат');
    }
}
