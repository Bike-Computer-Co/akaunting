<?php

namespace Database\Seeds;

use App\Abstracts\Model;
use App\Jobs\Setting\CreateCurrency;
use App\Traits\Jobs;
use Illuminate\Database\Seeder;

class Currencies extends Seeder
{
    use Jobs;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
        $company_id = $this->command->argument('company');

        $rows = [
            [
                'company_id' => $company_id,
                'name' => 'ден',
                'code' => 'MKD',
                'rate' => '1.00',
                'enabled' => '1',
                'precision' => config('money.MKD.precision'),
                'symbol' => config('money.MKD.symbol'),
                'symbol_first' => config('money.MKD.symbol_first'),
                'decimal_mark' => config('money.MKD.decimal_mark'),
                'thousands_separator' => config('money.MKD.thousands_separator'),
            ],
        ];

        foreach ($rows as $row) {
            $row['created_from'] = 'core::seed';

            $this->dispatch(new CreateCurrency($row));
        }
    }
}
