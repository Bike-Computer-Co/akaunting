<?php

namespace App\Jobs\Employees\Salaries;


use App\Abstracts\Job;
use App\Interfaces\Job\ShouldDelete;

class DeleteSalary extends Job implements ShouldDelete
{
    public function handle(): bool
    {

        $this->model->delete();

        return true;
    }

}
