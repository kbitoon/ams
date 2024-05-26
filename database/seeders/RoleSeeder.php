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
            'name' => 'Super Admin',
        ]);

        $admin = Role::create([
            'name' => 'Administrator',
        ]);

        $user = Role::create([
            'name' => 'User',
        ]);

        $anonymous = Role::create([
            'name' => 'Anonymous',
        ]);
    }
}
