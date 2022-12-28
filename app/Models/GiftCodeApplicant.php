<?php

namespace App\Models;

use App\Jobs\GiftCodeApplicantDiscordNotificationJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCodeApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_surname',
        'email',
        'phone_number',
        'registered_firm',
        'accountant',
        'advocate',
        'code',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($applicant) {
            GiftCodeApplicantDiscordNotificationJob::dispatch($applicant);
        });
    }
}
