# Clearance Instructions Setup

This document explains the setup for editable clearance instructions that can be managed by superadmin users.

## Files Created

1. **Migration**: `database/migrations/2025_01_15_000000_create_clearance_instructions_table.php`
   - Creates `clearance_instructions` table with `id`, `content` (text), and timestamps

2. **Model**: `app/Models/ClearanceInstruction.php`
   - Model for managing clearance instructions
   - Includes helper methods: `getContent()` and `updateContent()`

3. **Seeder**: `database/seeders/ClearanceInstructionSeeder.php`
   - Seeds default instruction content

4. **Livewire Component**: 
   - `app/Livewire/ClearanceInstruction.php` - Component logic
   - `resources/views/livewire/clearance-instruction.blade.php` - Component view

## Files Modified

1. **app/Livewire/Modals/ClearanceModal.php**
   - Updated to fetch instructions from database
   - Passes `$instructions` to the form view

2. **resources/views/livewire/forms/clearance-form.blade.php**
   - Updated to display instructions from database instead of hardcoded content

3. **resources/views/livewire/layout/settings.blade.php**
   - Added "Clearance Instructions" navigation link (superadmin only)
   - Added clearance instructions section

## Setup Instructions

1. **Run the migration:**
   ```bash
   php artisan migrate
   ```

2. **Run the seeder:**
   ```bash
   php artisan db:seed --class=ClearanceInstructionSeeder
   ```

   Or add it to `DatabaseSeeder.php`:
   ```php
   $this->call([
       // ... other seeders
       ClearanceInstructionSeeder::class,
   ]);
   ```

## Usage

1. **For Superadmin Users:**
   - Navigate to Settings page
   - Click on "Clearance Instructions" tab
   - Edit the content in the textarea (HTML is supported)
   - Click "Save Changes" to update
   - Preview is shown below the editor

2. **For All Users:**
   - The instructions automatically appear in the clearance form sidebar
   - Content is fetched from the database in real-time

## Features

- ✅ Database storage for instructions
- ✅ Editable by superadmin users only
- ✅ HTML support for rich formatting
- ✅ Live preview in the editor
- ✅ Automatic display in clearance form
- ✅ Default content seeded on installation

