<?php

namespace App\Models\Employees;

use App\Abstracts\Model;

class Salary extends Model
{

    protected $fillable = ['month', 'employee_id', 'amount', 'currency_code'];

    public function getLineActionsAttribute()
    {
        $actions = [];

        $actions[] = [
            'title' => trans('general.edit'),
            'icon' => 'edit',
            'url' => route('employees.salaries.edit', [$this->employee_id, $this->id]),
            'permission' => 'update-salary',
        ];

        $actions[] = [
            'type' => 'delete',
            'icon' => 'delete',
            'route' => 'salaries.destroy',
            'permission' => 'delete-salary',
            'model' => $this,
        ];

        return $actions;
    }

}
