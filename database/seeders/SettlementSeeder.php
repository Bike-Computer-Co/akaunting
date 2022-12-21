<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;

class SettlementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municipality = Municipality::query()
            ->where('name', 'Илинден')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Ајватовци'],
            ['name' => 'Бујковци'],
            ['name' => 'Бунарџик'],
            ['name' => 'Бучинци'],
            ['name' => 'Дељадровци'],
            ['name' => 'Илинден'],
            ['name' => 'Кадино'],
            ['name' => 'Марино'],
            ['name' => 'Миладиновци'],
            ['name' => 'Мралино'],
            ['name' => 'Мршевци'],
            ['name' => 'Текија'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Сарај')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Арнакија'],
            ['name' => 'Бојане'],
            ['name' => 'Буковиќ'],
            ['name' => 'Глумово'],
            ['name' => 'Горно Свиларе'],
            ['name' => 'Грчец'],
            ['name' => 'Дворце'],
            ['name' => 'Долно Свиларе'],
            ['name' => 'Кондово'],
            ['name' => 'Копаница'],
            ['name' => 'Крушопек'],
            ['name' => 'Ласкарци'],
            ['name' => 'Љубин'],
            ['name' => 'Матка'],
            ['name' => 'Паничари'],
            ['name' => 'Радуша'],
            ['name' => 'Раовиќ'],
            ['name' => 'Рашче'],
            ['name' => 'Рудник Радуша'],
            ['name' => 'Семениште'],
            ['name' => 'Скопје - Сарај *'],
            ['name' => 'Чајлане'],
            ['name' => 'Шишево'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Бутел')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Визбегово'],
            ['name' => 'Љубанци'],
            ['name' => 'Љуботен'],
            ['name' => 'Радишани'],
            ['name' => 'Скопје - Бутел *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Гази Баба')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Брњарци'],
            ['name' => 'Булачани'],
            ['name' => 'Гоце Делчев'],
            ['name' => 'Идризово'],
            ['name' => 'Инџиково'],
            ['name' => 'Јурумлери'],
            ['name' => 'Раштак'],
            ['name' => 'Сингелиќ'],
            ['name' => 'Скопје - Гази Баба *'],
            ['name' => 'Смиљковци'],
            ['name' => 'Стајковци'],
            ['name' => 'Страчинци'],
            ['name' => 'Трубарево'],
            ['name' => 'Црешево'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Ѓорче Петров')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Волково'],
            ['name' => 'Грачани'],
            ['name' => 'Кучково'],
            ['name' => 'Никиштане'],
            ['name' => 'Ново Село'],
            ['name' => 'Орман'],
            ['name' => 'Скопје - Ѓорче Петров *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Карпош')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Бардовци'],
            ['name' => 'Горно Нерези'],
            ['name' => 'Скопје - Карпош *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Кисела Вода')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Драчево'],
            ['name' => 'Скопје - Кисела Вода *'],
            ['name' => 'Усје'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Аеродром')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Долно Лисиче'],
            ['name' => 'Скопје - Аеродром *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Центар')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Скопје - Центар *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Чаир')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Скопје - Чаир *'],
        ]);

        $municipality = Municipality::query()
            ->where('name', 'Шуто Оризари')
            ->first();

        $municipality->settlements()->createMany([
            ['name' => 'Горно Оризари'],
            ['name' => 'Скопје - Шуто Оризари *'],
        ]);
    }
}
