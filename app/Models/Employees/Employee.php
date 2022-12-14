<?php

namespace App\Models\Employees;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    use Cloneable;

    protected $fillable = ['company_id', 'first_name', 'last_name', 'personal_number', 'birth_date', 'bank_account', 'occupation', 'address', 'email', 'phone', 'salary', 'enabled'];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function employmentHistories(): HasMany
    {
        return $this->hasMany(EmploymentHistory::class);
    }

    /**
     * Get the line actions.
     *
     * @return array
     */
    public function getLineActionsAttribute()
    {
        $actions = [];

        $actions[] = [
            'title' => trans('general.show'),
            'icon' => 'visibility',
            'url' => route('employees.show', $this->id),
            'permission' => 'read-employee',
        ];

        $actions[] = [
            'title' => trans('general.edit'),
            'icon' => 'edit',
            'url' => route('employees.edit', $this->id),
            'permission' => 'update-employee',
        ];

        $actions[] = [
            'type' => 'delete',
            'icon' => 'delete',
            'route' => 'employees.destroy',
            'permission' => 'delete-employee',
            'model' => $this,
        ];

        return $actions;
    }
}
