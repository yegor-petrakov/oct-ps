<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            [
                'name' => 'Завод "Фитнес-Фуд"',
                'address' => 'Россия, Самарская обл., г. Тольятти, тер. ОЭЗ ППТ, Ш 2-Е, зд. 3, стр. 4, офис 211, помещ. 20',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'ПАО "Орскнефтеоргсинтез"',
                'address' => '462407, Оренбургская обл., г. Орск, посёлок Победа, улица Гончарова, 1А',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Усинскгеонефть',
                'address' => 'Республика Коми, г. Усинск, ул. Магистральная, д. 13/1',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Завод Эггер в Гагарине',
                'address' => 'Россия, Смоленская обл., г. Гагарин, Эжвинский проезд, д. 1',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Завод Эггер в Гагарине',
                'address' => 'Россия, Смоленская обл., г. Гагарин, Эжвинский проезд, д. 1',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Завод Эггер в Шуе',
                'address' => 'Россия, 155908, Ивановская область, г. Шуя, Южное шоссе, 1',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Комбинат Брестхлебопродукт',
                'address' => 'Республика Беларусь, г. Брест, ул. Дворчик, 18',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
            [
                'name' => 'Завод Лесплитинвест',
                'address' => 'Россия, Ленинградская обл., г. Приозерск, ул. Заводская, д. 7',
                'note' => null,
                'created_at' => '2025-11-03 13:25:00',
                'updated_at' => null,
            ],
        ];

        foreach ($sites as $site) {
            DB::table('sites')->updateOrInsert(
                ['name' => $site['name']], // Unique key
                [
                    'id' => Str::uuid(),
                    'address' => $site['address'],
                    'note' => $site['note'],
                    'is_archived' => false,
                    'created_at' => $site['created_at'],
                    'updated_at' => $site['updated_at'] ?? $site['created_at'],
                ]
            );
        }
    }
}