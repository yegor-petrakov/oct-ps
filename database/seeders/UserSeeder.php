<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'yegor_petrakov',
                'first_name' => 'Егор',
                'middle_name' => 'Евгеньевич',
                'last_name' => 'Петраков',
                'email' => 'pe@polymermc.ru',
                'phone' => '+7 900 111 1111',
                'password' => 'wRz67m',
                'is_archived' => false,
                'roles' => ['admin', 'manager'],
            ],
            [
                'username' => 'yaroslav_abasov',
                'first_name' => 'Ярослав',
                'middle_name' => 'Олегович',
                'last_name' => 'Абасов',
                'email' => 'ya@polymermc.ru',
                'phone' => '+7 900 000 0000',
                'password' => 'wRz67m',
                'is_archived' => false,
                'roles' => ['serviceman'],
            ],
            // [
            //     'username' => 'alexander_fenev',
            //     'first_name' => 'Александр',
            //     'middle_name' => 'Викторович',
            //     'last_name' => 'Фенёв',
            //     'email' => 'fenev@polymermc.ru',
            //     'phone' => '+7 900 111 1111',
            //     'password' => 'string',
            //     'is_archived' => false,
            //     'roles' => ['manager'],
            // ],
            // [
            //     'username' => 'alexey_yurlov',
            //     'first_name' => 'Алексей',
            //     'middle_name' => 'Евгеньевич',
            //     'last_name' => 'Юрлов',
            //     'email' => '9061112233@polymermc.ru',
            //     'phone' => '+7 900 111 1111',
            //     'password' => 'string',
            //     'is_archived' => false,
            //     'roles' => ['manager'],
            // ],
            // [
            //     'username' => 'anton_gorshkov',
            //     'first_name' => 'Антон',
            //     'middle_name' => 'Олегович',
            //     'last_name' => 'Горшков',
            //     'email' => 'ag@polymermc.ru',
            //     'phone' => '+7 900 111 1111',
            //     'password' => 'string',
            //     'is_archived' => false,
            //     'roles' => ['manager'],
            // ],
            // [
            //     'username' => 'maxim_ponomarev',
            //     'first_name' => 'Максим',
            //     'middle_name' => '',
            //     'last_name' => 'Пономарёв',
            //     'email' => 'mp@polymermc.ru',
            //     'phone' => '+7 900 111 1111',
            //     'password' => 'string',
            //     'is_archived' => false,
            //     'roles' => ['manager'],
            // ],
        ];

        foreach ($users as $data) {

            // Prepare user attributes (hash password here)
            $attributes = collect($data)
                ->except('roles')
                ->merge([
                    'password' => Hash::make($data['password']),
                ])
                ->toArray();

            // Create or update by email
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                $attributes
            );

            // Sync roles without detaching existing ones
            // $roleIds = Role::whereIn('name', $data['roles'])->pluck('id');
            // $user->roles()->syncWithoutDetaching($roleIds);
        }
    }
}