<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Super\Employee;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends BaseController
{
    public function index(): Response
    {
        $employees = Employee::query()
            ->with('company')
            ->latest()
            ->paginate(20);

        return Inertia::render('Employee/Index', compact('employees'));
    }

    public function show(Employee $employee): Response
    {
        $employee->loadMissing('company', 'employmentHistories');

        return Inertia::render('Employee/Show', compact('employee'));
    }
}
