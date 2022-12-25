<?php

namespace App\Http\Controllers\Inertia;

use App\Models\FirmRegistrationAttempt;
use Inertia\Inertia;
use Inertia\Response;

class FirmRegistrationAttemptController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', FirmRegistrationAttempt::class);
        $attempts = FirmRegistrationAttempt::query()
            ->paginate(20);

        return Inertia::render('FirmRegistrationAttempt/Index', compact('attempts'));
    }
}
