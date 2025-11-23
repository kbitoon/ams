<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\BarangayService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder creates a super admin user for the current barangay.
     * It only runs once - if the user already exists, it won't create a duplicate.
     */
    public function run(): void
    {
        $barangayId = BarangayService::getCurrentBarangayId();
        $barangayName = BarangayService::getCurrentBarangayName();

        // If BARANGAY_ID is not set, skip seeding
        if (!$barangayId) {
            $this->command->warn('BARANGAY_ID is not set in .env. Skipping super admin seeder.');
            return;
        }

        // Generate email based on barangay name
        // Convert barangay name to lowercase, remove spaces and special characters
        $barangayDomain = Str::lower(Str::slug($barangayName, ''));
        // If barangay name is empty or results in empty domain, use a default
        if (empty($barangayDomain)) {
            $barangayDomain = 'barangay';
        }
        $email = "superadmin@{$barangayDomain}.com";

        // Check if user already exists (check across all barangays to avoid duplicates)
        $existingUser = User::allBarangays()
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            $this->command->info("Super admin user with email '{$email}' already exists. Skipping creation.");
            return;
        }

        // Generate password from base64 encoded barangay_id
        $password = base64_encode((string) $barangayId);

        // Create the super admin user
        // Use allBarangays() to bypass scope during creation, then set barangay_id explicitly
        $user = User::allBarangays()->create([
            'name' => 'Super Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'barangay_id' => $barangayId,
            'email_verified_at' => now(), // Auto-verify email for super admin
        ]);

        // Ensure superadmin role exists, then assign it
        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $user->assignRole($role);

        $this->command->info("Super admin user created successfully!");
        $this->command->info("Email: {$email}");
        $this->command->info("Password: {$password} (base64 encoded barangay_id: {$barangayId})");
        $this->command->info("Barangay: {$barangayName} (ID: {$barangayId})");
    }
}

