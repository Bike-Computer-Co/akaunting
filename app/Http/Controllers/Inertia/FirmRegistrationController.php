<?php

namespace App\Http\Controllers\Inertia;

use App\Enums\MediaUsage;
use App\Http\Requests\FirmRegistrationRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\Auth\User;
use App\Models\Bank;
use App\Models\FirmRegistration;
use App\Models\Municipality;
use App\Notifications\FirmEnrollmentUploadedNotification;
use App\Notifications\SuccessfullyRegisteredFirmAndProfileNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class FirmRegistrationController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $firmRegistrations = FirmRegistration::query()
            ->with('user')
            ->paginate(10);

        return Inertia::render('FirmRegistration/Index', compact('firmRegistrations'));
    }

    public function show(FirmRegistration $firmRegistration): Response
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $firmRegistration
            ->loadMissing('headquartersMunicipality', 'headquartersSettlement', 'bank', 'subsidiaryMunicipality', 'subsidiarySettlement', 'enrollmentDecision');

        return Inertia::render('FirmRegistration/Show', compact('firmRegistration'));
    }

    public function create(): Response
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $banks = Bank::all();
        $municipalities = Municipality::query()
            ->with('settlements')
            ->get();

        return Inertia::render('FirmRegistration/Create', compact('banks', 'municipalities'));
    }

    public function store(FirmRegistrationRequest $request): Redirector|Application|RedirectResponse
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        FirmRegistration::createFirmRegistration($request);

        return redirect(route('super.firm-registrations.index'))
            ->with('success', 'Успешно ја креиравте оваа регистрација на фирма');
    }

    public function edit(FirmRegistration $firmRegistration): Response
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $banks = Bank::all();
        $municipalities = Municipality::query()
            ->with('settlements')
            ->get();

        return Inertia::render('FirmRegistration/Edit', compact('banks', 'municipalities', 'firmRegistration'));
    }

    public function update(FirmRegistration $firmRegistration, FirmRegistrationRequest $request): Redirector|Application|RedirectResponse
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
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
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $firmRegistration->uploadAndCreateMedia($request->file('file'), MediaUsage::FILE, 'firm-enrollment-decisions');

        $mails = ['jordancho@venikom.com', 'ivan@venikom.com', 'martin.bojmaliev@venikom.com', 'dushancimbalevic@gmail.com'];

        $password = Str::random(); // generate random password with 16 characters
        $data = [
            "name" => $firmRegistration->founder_name,
            "email" => $firmRegistration->email,
            "password" => bcrypt($password),
            "company_name" => $firmRegistration->firm_name,
            "locale" => 'mk-MK',
            "currency" => "MKD",
            "country" => "MK",
        ];
        $user = User::createNewUser($data);

        $firmRegistration->user_id = $user->id;
        $firmRegistration->save();

        $token = app('auth.password.broker')->createToken($user);

        $resetPasswordUrl = route('reset', [
            'token' => $token,
            'email' => $firmRegistration->email,
        ]);

        Notification::route('mail', $user->email)->notify(new SuccessfullyRegisteredFirmAndProfileNotification($user, $resetPasswordUrl));

        Notification::route('mail', $mails)->notify(new FirmEnrollmentUploadedNotification($firmRegistration));

        return back()->with('success', 'Успешно го прикачивте решението за упис');
    }

    public function destroy(FirmRegistration $firmRegistration): RedirectResponse
    {
        $this->authorize('hasAllPermissions', FirmRegistration::class);
        $firmRegistration->delete();

        return back()->with('success', 'Успешно ја избришавте оваа регистрација на фирма');
    }
}
