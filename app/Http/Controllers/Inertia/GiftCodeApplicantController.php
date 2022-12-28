<?php

namespace App\Http\Controllers\Inertia;

use App\Models\GiftCodeApplicant;
use Inertia\Inertia;
use Inertia\Response;

class GiftCodeApplicantController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', GiftCodeApplicant::class);

        $giftCodeApplicants = GiftCodeApplicant::query()
            ->paginate(20);

        return Inertia::render('GiftCodeApplicant/Index', compact('giftCodeApplicants'));
    }
}
