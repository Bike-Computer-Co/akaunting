<?php

namespace App\Jobs\Employees;

use App\Abstracts\Job;
use App\Interfaces\Job\ShouldDelete;

class DeleteEmployee extends Job implements ShouldDelete
{
    public function handle(): bool
    {
        $this->model->delete();

        return true;
    }
}
