<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Enums\EmploymentHistoryType;
use App\Http\Requests\Employee as Request;
use App\Jobs\Employees\CreateEmployee;
use App\Jobs\Employees\DeleteEmployee;
use App\Jobs\Employees\UpdateEmployee;
use App\Models\Employees\Employee as Model;
use App\Models\EmploymentHistory;
use Carbon\Carbon;

class Employee extends Controller
{
    public function index()
    {
        $employees = Model::query()->collect();

        return $this->response('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateEmployee($request));

        if ($response['success']) {
            if ($request->get('sign_up_employment_history')) {
                $request->validate([
                    'sign_up_employment_history' => 'after:'.Carbon::now()->addDays(2)->format('Y-m-d'),
                ]);
                EmploymentHistory::query()->create([
                    'employment_history_date' => $request->get('sign_up_employment_history'),
                    'type' => EmploymentHistoryType::SIGN_UP->value,
                    'employee_id' => $response['data']->id,
                ]);
            }

            $response['redirect'] = route('employees.show', $response['data']->id);

            $message = trans('messages.success.added', ['type' => trans_choice('general.employees', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('employees.create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function edit(Model $employee)
    {
        $type = null;
        if ($employee->employmentHistories()->exists()) {
            $type = $employee->employmentHistories()->latest()->first()->type;
        }

        return view('employees.edit', compact('employee', 'type'));
    }

    public function update(Model $employee, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateEmployee($employee, $request));

        if ($response['success']) {
            if ($request->get('sign_out_employment_history')) {
                $request->validate([
                    'sign_out_employment_history' => 'after:'.Carbon::now()->subDays(6)->format('Y-m-d'),
                ]);
                EmploymentHistory::query()->create([
                    'employment_history_date' => $request->get('sign_out_employment_history'),
                    'type' => EmploymentHistoryType::SIGN_OUT->value,
                    'employee_id' => $response['data']->id,
                ]);
            }
            if ($request->get('sign_up_employment_history')) {
                $request->validate([
                    'sign_up_employment_history' => 'after:'.Carbon::now()->addDays(2)->format('Y-m-d'),
                ]);
                EmploymentHistory::query()->create([
                    'employment_history_date' => $request->get('sign_up_employment_history'),
                    'type' => EmploymentHistoryType::SIGN_UP->value,
                    'employee_id' => $response['data']->id,
                ]);
            }

            $response['redirect'] = route('employees.show', $employee->id);

            $message = trans('messages.success.updated', ['type' => $employee->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('employees.edit', $employee->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function show(Model $employee)
    {
        $salaries = $employee->salaries()->collect();
        $employmentHistories = $employee->employmentHistories()->collect();

        return view('employees.show', compact('employee', 'salaries', 'employmentHistories'));
    }

    public function destroy(Model $employee)
    {
        $response = $this->ajaxDispatch(new DeleteEmployee($employee));

        $response['redirect'] = route('employees.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $employee->first_name.' '.$employee->last_name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }
}
