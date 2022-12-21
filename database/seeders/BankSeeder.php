<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Стопанска банка',
                'logo' => '/images/bank/stopanska.svg',
            ],
            [
                'name' => 'НЛБ банка',
                'logo' => '/images/bank/nlb.svg',
            ],
            [
                'name' => 'Халк банка',
                'logo' => '/images/bank/halk.svg',
            ],
            [
                'name' => 'Комерцијална банка',
                'logo' => '/images/bank/komercijalna.svg',
            ],
            [
                'name' => 'Капитал банка',
                'logo' => '/images/bank/capital.svg',
            ],
            [
                'name' => 'ПроКредит банка',
                'logo' => '/images/bank/pro-credit.svg',
            ],
            [
                'name' => 'Развојна Банка на Северна Македонија',
                'logo' => '/images/bank/razvojna.svg',
            ],
            [
                'name' => 'Силк Роуд Банка',
                'logo' => '/images/bank/silk-road.svg',
            ],
            [
                'name' => 'ТТК Банка',
                'logo' => '/images/bank/ttk.svg',
            ],
            [
                'name' => 'УНИ Банка',
                'logo' => '/images/bank/uni.svg',
            ],
            [
                'name' => 'Централна Кооперативна Банка',
                'logo' => '/images/bank/centralna.svg',
            ],
            [
                'name' => 'Шпаркасе Банка',
                'logo' => '/images/bank/shparkase.svg',
            ],
        ])->each(function ($bank) {
            Bank::query()->create($bank);
        });
    }
}
