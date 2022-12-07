<?php

namespace App\BulkActions;

use App\Abstracts\BulkAction;
use App\Jobs\Employees\DeleteEmployee;
use App\Models\Employees\Employee;

class Employees extends BulkAction
{
    public $model = Employee::class;

    public $text = 'general.employees';

    public $path = [
        'type' => 'employees',
        'group' => 'employees',
    ];

    public $actions = [
        //        'enable'    => [
        //            'icon'          => 'check_circle',
        //            'name'          => 'general.enable',
        //            'message'       => 'bulk_actions.message.enable',
        //            'permission'    => 'update-banking-accounts',
        //        ],
        //        'disable'   => [
        //            'icon'          => 'hide_source',
        //            'name'          => 'general.disable',
        //            'message'       => 'bulk_actions.message.disable',
        //            'permission'    => 'update-banking-accounts',
        //        ],
        'delete' => [
            'icon' => 'delete',
            'name' => 'general.delete',
            'message' => 'bulk_actions.message.delete',
            'permission' => 'delete-employee',
        ],
    ];

    public function destroy($request)
    {
        $accounts = $this->getSelectedRecords($request);

        foreach ($accounts as $account) {
            try {
                $this->dispatch(new DeleteEmployee($account));
            } catch (\Exception $e) {
                flash($e->getMessage())->error()->important();
            }
        }
    }
}
