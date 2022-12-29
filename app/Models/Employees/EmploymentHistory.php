<?php

namespace App\Models\Employees;

use App\Abstracts\Model;
use App\Enums\EmploymentHistoryType;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class EmploymentHistory extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = ['employee_id', 'type', 'employment_history_date', 'employment_announcement_sent'];

    protected $casts = [
        'type' => EmploymentHistoryType::class,
        'employment_announcement_sent' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function m1m2(): MorphOne
    {
        return $this->morphOneFile();
    }
}
