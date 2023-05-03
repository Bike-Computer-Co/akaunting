<?php

namespace App\Console\Commands;

use App\Models\Common\Company;
use Illuminate\Console\Command;

class SendAccountantStatement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'digitalhub:send-accountant-statement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send details to accountant';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $company = Company::query()
            ->ourAccountant()
            ->whereHas('settings', fn($q)=> $q->whereNotNull('company.accountant_email'))
            ->get()
            ->each(function ($company){

            });
        return Command::SUCCESS;
    }
}
