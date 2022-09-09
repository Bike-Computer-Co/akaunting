<?php

namespace App\Console\Commands;

use App\Models\Employees\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlySalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'digitalhub:generate-monthly-salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monthly salary';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Employee::where('enabled', true)->with('company')->withoutGlobalScopes()->get()->each(
            fn($employee) => $employee->salaries()->create([
                'amount' => $employee->salary,
                'month' => now()->toDateString(),
                'currency_code' => $employee->company->currency
            ])
        );
        return 0;
    }
}
