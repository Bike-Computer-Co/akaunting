<?php

namespace App\Http\Controllers\Inertia;

use App\Enums\MediaUsage;
use App\Http\Requests\FirmRegistrationRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\Bank;
use App\Models\FirmRegistration;
use App\Models\Municipality;
use App\Notifications\FirmEnrollmentUploadedNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Routing\Controller as BaseController;

class FirmRegistrationController extends BaseController
{
    public function index(): Response
    {
        $firmRegistrations = FirmRegistration::query()
            ->paginate(10);

        return Inertia::render('FirmRegistration/Index', compact('firmRegistrations'));
    }

    public function show(FirmRegistration $firmRegistration): Response
    {
        $firmRegistration
            ->loadMissing('headquartersMunicipality', 'headquartersSettlement', 'bank', 'subsidiaryMunicipality', 'subsidiarySettlement', 'enrollmentDecision');

        return Inertia::render('FirmRegistration/Show', compact('firmRegistration'));
    }

    public function create(): Response
    {
        $banks = Bank::all();
        $municipalities = Municipality::query()
            ->with('settlements')
            ->get();

        return Inertia::render('FirmRegistration/Create', compact('banks', 'municipalities'));
    }

    public function store(FirmRegistrationRequest $request): Redirector|Application|RedirectResponse
    {
        FirmRegistration::createFirmRegistration($request);

        return redirect(route('super.firm-registrations.index'))
            ->with('success', 'Успешно ја креиравте оваа регистрација на фирма');
    }

    public function edit(FirmRegistration $firmRegistration): Response
    {
        $banks = Bank::all();
        $municipalities = Municipality::query()
            ->with('settlements')
            ->get();

        return Inertia::render('FirmRegistration/Edit', compact('banks', 'municipalities', 'firmRegistration'));
    }

    public function update(FirmRegistration $firmRegistration, FirmRegistrationRequest $request): Redirector|Application|RedirectResponse
    {
        $firmRegistration->fill($request->validated());
        $firmRegistration->bank()->associate($request->input('bank_id'));
        $firmRegistration->headquartersMunicipality()->associate($request->input('headquarters_municipality_id'));
        $firmRegistration->subsidiaryMunicipality()->associate($request->input('subsidiary_municipality_id'));
        $firmRegistration->headquartersSettlement()->associate($request->input('headquarters_settlement_id'));
        $firmRegistration->subsidiarySettlement()->associate($request->input('subsidiary_settlement_id'));
        $firmRegistration->save();

        return redirect(route('super.firm-registrations.index'))
            ->with('success', 'Успешно ја изменивте оваа регистрација на фирма');
    }

    public function uploadFirmEnrollmentDecision(FirmRegistration $firmRegistration, UploadFileRequest $request): RedirectResponse
    {
        $firmRegistration->uploadAndCreateMedia($request->file('file'), MediaUsage::FILE, 'firm_enrollment_decisions');

        $mails = ['jordancho@venikom.com', 'ivan@venikom.com', 'martin.bojmaliev@venikom.com', 'dushancimbalevic@gmail.com'];
        Notification::route('mail', $mails)->notify(new FirmEnrollmentUploadedNotification($firmRegistration));

        return back()->with('success', 'Успешно го прикачивте решението за упис');
    }

    public function destroy(FirmRegistration $firmRegistration): RedirectResponse
    {
        $firmRegistration->delete();

        return back()->with('success', 'Успешно ја избришавте оваа регистрација на фирма');
    }
}
