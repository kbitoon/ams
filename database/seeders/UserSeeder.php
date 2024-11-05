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

        $administrator->assignRole('administrator');

        $support = User::factory()->create([
            'name' => 'Support',
            'email' => 'support@ams.com',
            'password' => Hash::make('$upp0rt'),
        ]);

        $support->assignRole('support');

        $janah = User::factory()->create([
            'name' => 'Janah Cabahug',
            'email' => 'janah@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $janah->assignRole('administrator');

        $apple = User::factory()->create([
            'name' => 'Apple Dacoron',
            'email' => 'apple@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $apple->assignRole('administrator');

        $sheily = User::factory()->create([
            'name' => 'Sheily Senolos',
            'email' => 'sheily@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $sheily->assignRole('administrator');

        $fanny = User::factory()->create([
            'name' => 'Fanny Manigo',
            'email' => 'fanny@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $fanny->assignRole('support');

        $nanet = User::factory()->create([
            'name' => 'Nanet Villena',
            'email' => 'nanet@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $nanet->assignRole('support');

        $dahlia = User::factory()->create([
            'name' => 'Dahlia Abao',
            'email' => 'dahlia@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $dahlia->assignRole('support');

        $connie = User::factory()->create([
            'name' => 'Connie Vendero',
            'email' => 'connie@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $connie->assignRole('support');

        $jojo = User::factory()->create([
            'name' => 'Jojo Saornido',
            'email' => 'jojo@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $jojo->assignRole('administrator');

        $lovely = User::factory()->create([
            'name' => 'Lovely Colot',
            'email' => 'lovely@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $lovely->assignRole('administrator');

        $jenelyn = User::factory()->create([
            'name' => 'Jenelyn Leyson',
            'email' => 'jenelyn@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $jenelyn->assignRole('administrator');

        $vivian = User::factory()->create([
            'name' => 'Vivian Desierto',
            'email' => 'vivian@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $vivian->assignRole('administrator');

        $noel = User::factory()->create([
            'name' => 'Noel Bermoy',
            'email' => 'noel@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $noel->assignRole('support');

        $rory = User::factory()->create([
            'name' => 'Rory Cinco',
            'email' => 'rory@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $rory->assignRole('support');

        $agnes = User::factory()->create([
            'name' => 'Agnes Cacha',
            'email' => 'agnes@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $agnes->assignRole('support');

        $janice = User::factory()->create([
            'name' => 'Janice Anana',
            'email' => 'janice@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $janice->assignRole('support');

        $cora = User::factory()->create([
            'name' => 'Cora Rajamoda',
            'email' => 'cora@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $cora->assignRole('administrator');

        $eric = User::factory()->create([
            'name' => 'Eric Deldig',
            'email' => 'eric@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $eric->assignRole('support');

        $efren = User::factory()->create([
            'name' => 'Efren Lauron',
            'email' => 'efren@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $efren->assignRole('support');

        $liza = User::factory()->create([
            'name' => 'Liza Casanares',
            'email' => 'liza@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $liza->assignRole('support');

        $sally = User::factory()->create([
            'name' => 'Sally Lecciones',
            'email' => 'sally@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $sally->assignRole('support');

        $aira = User::factory()->create([
            'name' => 'Aira Codeniera',
            'email' => 'aira@bacayan.com',
            'password' => Hash::make('secret'),
        ]);

        $aira->assignRole('administrator');
    }
}