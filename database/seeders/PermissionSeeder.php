<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'add clearance',
            'edit clearance',
            'delete clearance',
            'view clearance',
            'add complaint',
            'edit complaint',
            'delete complaint',
            'view complaint',
            'add announcement',
            'edit announcement',
            'delete announcement',
            'view announcement',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
