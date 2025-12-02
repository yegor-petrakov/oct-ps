<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['ООО "ЭГГЕР ДРЕВПРОДУКТ ГАГАРИН"', 'ГФ5'],
            ['ООО "ЭГГЕР ДРЕВПРОДУКТ ШУЯ"', 'ЭД2'],
            ['ООО "Поволжская научно-исследовательская компания"', 'ПН4'],
            ['ОАО "ФИТНЕС-ФУД"', 'ФФ4'],
            ['ОАО "ЛЕСПЛИТИНВЕСТ"', 'ЛП16'],
            ['ООО "ХОТСТИЛ"', 'ХС9']
        ];


        foreach ($customers as $customer) {
            DB::table('customers')->updateOrInsert(
                ['number' => $customer[1]],
                [
                    'id' => Str::uuid(),
                    'name' => $customer[0],
                    'is_archived' => false,
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
}