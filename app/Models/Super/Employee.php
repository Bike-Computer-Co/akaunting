<?php

namespace App\Models\Super;

use App\Models\Common\Company;
use App\Models\Employees\EmploymentHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    public function getUpdatedAtAttribute($val): string
    {
        return Carbon::parse($val)->format('H:i:s d-m-Y');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function employmentHistories(): HasMany
    {
        return $this->hasMany(EmploymentHistory::class);
    }
}
