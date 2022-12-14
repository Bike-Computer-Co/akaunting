<?php

namespace App\Models;

use App\Abstracts\Model;
use App\Enums\EmploymentHistoryType;
use App\Models\Employees\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'type', 'employment_history_date'];

    protected $casts = [
        'type' => EmploymentHistoryType::class,
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
