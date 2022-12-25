<?php

namespace App\Models;

use App\Jobs\FirmRegistrationAttemptDiscordNotificationJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmRegistrationAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    protected static function boot()
    {
        parent::boot();

        self::created(function (FirmRegistrationAttempt $firmRegistrationAttempt) {
            FirmRegistrationAttemptDiscordNotificationJob::dispatch($firmRegistrationAttempt);
        });
    }
}
