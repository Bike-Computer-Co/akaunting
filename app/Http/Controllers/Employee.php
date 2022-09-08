<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Http\Requests\Employee as Request;
use App\Jobs\Employees\CreateEmployee;
use App\Jobs\Employees\DeleteEmployee;
use App\Jobs\Employees\UpdateEmployee;
use App\Models\Employees\Employee as Model;

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
        return view('employees.edit', compact('employee'));
    }

    public function update(Model $employee, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateEmployee($employee, $request));

        if ($response['success']) {
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
        return view('employees.show', compact('employee'));
    }

    public function destroy(Model $employee)
    {
        $response = $this->ajaxDispatch(new DeleteEmployee($employee));

        $response['redirect'] = route('accounts.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $employee->first_name . ' ' . $employee->last_name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }
}
