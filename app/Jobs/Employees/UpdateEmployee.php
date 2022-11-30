<?php

namespace App\Jobs\Employees;

use App\Abstracts\Job;
use App\Interfaces\Job\ShouldUpdate;
use App\Models\Employees\Employee;

class UpdateEmployee extends Job implements ShouldUpdate
{

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->model->update($this->request->all());
        return $this->model;
    }
}