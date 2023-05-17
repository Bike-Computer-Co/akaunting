<?php

namespace App\Console\Commands;

use App\Jobs\SendAccountantStatementJob;
use App\Models\Common\Company;
use App\Models\Setting\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        Company::query()
            ->whereIn('id', DB::table('settings')->select('company_id')->where('key', 'company.accountant_email')->whereNotNull('value'))
            ->get()
            ->each(function ($company){
                SendAccountantStatementJob::dispatch($company);
            });
        return Command::SUCCESS;
    }
}
