<?php

namespace App\Jobs\Employees;

use App\Abstracts\Job;
use App\Interfaces\Job\ShouldCreate;
use App\Models\Employees\Employee;

class CreateEmployee extends Job implements ShouldCreate
{
    public function handle()
    {
        $this->model = Employee::create($this->request->all());
        return $this->model;
    }
}
