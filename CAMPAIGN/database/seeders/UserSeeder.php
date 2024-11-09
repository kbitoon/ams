<?php

namespace Database\Seeders;

use App\Models\CampaignUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $campaignAdmin = CampaignUser::factory()->create([
            'name' => 'Campaign Admin',
            'email' => 'admin@campaign.com',
            'password' => Hash::make('campaign_admin'),
        ]);
    }
}