<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Anonymous User',
            'email' => 'anonymous@ams.com',
            'password' => Hash::make('P@$$w0rd!'),
        ]);

        $user->assignRole('anonymous');

        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@ams.com',
            'password' => Hash::make('$upp3r!@#'),
        ]);

        $superadmin->assignRole('superadmin');

        $administrator = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'administrator@ams.com',
            'password' => Hash::make('@dm1n1$tr@tor'),
        ]);

        $administrator->assignRole('superadmin');

        $support = User::factory()->create([
            'name' => 'Support',
            'email' => 'support@ams.com',
            'password' => Hash::make('$upp0rt'),
        ]);

        $support->assignRole('support');
    }
}