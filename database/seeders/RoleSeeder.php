<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'admin',
            'manager',
            'serviceman',
            'finance',
            'viewer',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName],
                [
                    'display_name' => ucfirst($roleName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
