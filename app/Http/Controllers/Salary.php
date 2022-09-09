<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Jobs\Employees\Salaries\DeleteSalary;
use App\Jobs\Employees\Salaries\UpdateSalary;
use Illuminate\Http\Request;
use App\Models\Employees\Salary as Model;
use \App\Models\Employees\Employee;
class Salary extends Controller
{
    public function edit(Employee $employee, Model $salary)
    {
        return view('employees.salaries.edit', compact('salary'));
    }

    public function update(Employee $employee, Model $salary, Request $request)
    {
        $request->validate([
            'amount'=> 'nullable|numeric'
        ]);
        $response = $this->ajaxDispatch(new UpdateSalary($salary, $request));

        if ($response['success']) {
            $response['redirect'] = route('employees.show', $employee->id);

            $message = trans('messages.success.updated', ['type' => $employee->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('employees.salaries.edit', $employee->id, $salary->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function destroy(Model $salary)
    {
        $response = $this->ajaxDispatch(new DeleteSalary($salary));

        $response['redirect'] = route('employees.show', $salary->employee_id);

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $salary->amount]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }
}
