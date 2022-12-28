<?php

namespace App\Http\Controllers\Inertia;

use App\Enums\MediaUsage;
use App\Http\Requests\UploadFileRequest;
use App\Models\Employees\EmploymentHistory;
use App\Models\Super\Employee;
use Illuminate\Http\RedirectResponse;
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
        $employee->loadMissing('company', 'employmentHistories', 'employmentHistories.m1m2');

        return Inertia::render('Employee/Show', compact('employee'));
    }

    public function employmentAnnouncementSent(Employee $employee, EmploymentHistory $employmentHistory): RedirectResponse
    {
        $this->authorize('hasAllPermissions', Employee::class);
        $employmentHistory->employment_announcement_sent = true;
        $employmentHistory->save();

        return back()->with('success', 'Успешно означивте дека за овој вработен е пуштен оглас за вработување');
    }

    public function attachM1M2(Employee $employee, EmploymentHistory $employmentHistory, UploadFileRequest $request): RedirectResponse
    {
        $this->authorize('hasAllPermissions', Employee::class);
        $employmentHistory->uploadAndCreateMedia($request->file('file'), MediaUsage::FILE, 'm1m2-files');

        return back()->with('success', 'Успешно го прикачивте овој M1M2 образец');
    }
}
