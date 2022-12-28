<?php

namespace App\Models;

use App\Enums\FormOfFirm;
use App\Enums\StakeDuration;
use App\Enums\StakeType;
use App\Enums\StampType;
use App\Jobs\FirmRegistrationDiscordNotificationJob;
use App\Models\Auth\User;
use App\Notifications\RegistrationSubmittedNotification;
use App\Notifications\SuccessfullySentRegistrationNotification;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class FirmRegistration extends Model
{
    use HasFactory, SoftDeletes, HasMedia;

    protected $casts = [
        'form_of_firm' => FormOfFirm::class,
        'stake_duration' => StakeDuration::class,
        'stake_type' => StakeType::class,
        'stamp_type' => StampType::class,
    ];

    protected $fillable = [
        'form_of_firm',
        'firm_name',
        'founder_name',
        'founder_address',
        'founder_embg',
        'founder_id_number',
        'manager_name',
        'manager_address',
        'manager_embg',
        'headquarters_address',
        'subsidiary_address',
        'occupation_code',
        'stake_duration',
        'stake_type',
        'stamp_address',
        'stamp_type',
        'phone',
        'email',
    ];

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->tz('UTC')->format('d/m/Y H:m:s');
    }

    public function headquartersMunicipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'headquarters_municipality_id');
    }

    public function headquartersSettlement(): BelongsTo
    {
        return $this->belongsTo(Settlement::class, 'headquarters_settlement_id');
    }

    public function subsidiaryMunicipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'subsidiary_municipality_id');
    }

    public function subsidiarySettlement(): BelongsTo
    {
        return $this->belongsTo(Settlement::class, 'subsidiary_settlement_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function enrollmentDecision(): MorphOne
    {
        return $this->morphOneFile();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function createFirmRegistration($request): FirmRegistration
    {
        $firm = new FirmRegistration($request->validated());
        $firm->bank()->associate($request->input('bank_id'));
        $firm->headquartersMunicipality()->associate($request->input('headquarters_municipality_id'));
        $firm->subsidiaryMunicipality()->associate($request->input('subsidiary_municipality_id'));
        $firm->headquartersSettlement()->associate($request->input('headquarters_settlement_id'));
        $firm->subsidiarySettlement()->associate($request->input('subsidiary_settlement_id'));
        $firm->save();

        return $firm;
    }

    protected static function boot()
    {
        parent::boot();
        self::created(function (FirmRegistration $firmRegistration) {
            Notification::route('mail', $firmRegistration->email)->notify(new SuccessfullySentRegistrationNotification($firmRegistration));
            $mails = ['jordancho@venikom.com', 'ivan@venikom.com', 'martin.bojmaliev@venikom.com', 'advokatlefkov@gmail.com'];
            Notification::route('mail', $mails)->notify(new RegistrationSubmittedNotification($firmRegistration));
            FirmRegistrationDiscordNotificationJob::dispatch($firmRegistration);
        });
    }
}
