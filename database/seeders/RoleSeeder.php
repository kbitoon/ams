<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create([
            'name' => 'superadmin',
        ]);

        $admin = Role::create([
            'name' => 'administrator',
        ]);

        $user = Role::create([
            'name' => 'user',
        ]);

        $anonymous = Role::create([
            'name' => 'anonymous',
        ]);
    }
}
