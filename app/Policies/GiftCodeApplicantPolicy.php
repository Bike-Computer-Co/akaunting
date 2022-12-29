<?php

namespace App\Policies;

use App\Enums\SuperType;
use App\Models\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftCodeApplicantPolicy
{
    use HandlesAuthorization;

    public function hasAllPermissions(User $user): bool
    {
        return in_array($user->super_type, [SuperType::SUPER]);
    }
}
