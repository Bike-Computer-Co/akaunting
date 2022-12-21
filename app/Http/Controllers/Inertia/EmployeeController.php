<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Super\Employee;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', Employee::class);
        $employees = Employee::query()
            ->with('company')
            ->latest()
            ->paginate(20);

        return Inertia::render('Employee/Index', compact('employees'));
    }

    public function show(Employee $employee): Response
    {
        $this->authorize('hasAllPermissions', Employee::class);
        $employee->loadMissing('company', 'employmentHistories');

        return Inertia::render('Employee/Show', compact('employee'));
    }
}
