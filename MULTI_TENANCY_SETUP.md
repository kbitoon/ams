# Multi-Tenancy Setup Guide

This application supports multi-tenancy, allowing you to deploy the same application to multiple barangays while sharing a single database. Each deployment is isolated by a `barangay_id` identifier.

## How It Works

- Each deployment has a unique `BARANGAY_ID` in its `.env` file
- All database queries are automatically filtered by `barangay_id`
- Data is automatically isolated between different barangays
- Settings (categories, clearance types, etc.) are per-barangay

## Setup Instructions

### 1. Configure Environment Variables

For each barangay deployment, add to `.env`:

```env
BARANGAY_ID=1
BARANGAY_NAME="Barangay Bacayan"
```

**Important:** Each barangay must have a unique `BARANGAY_ID` (1, 2, 3, etc.)

### 2. Run Migrations

Run the migrations to add `barangay_id` columns to all tables:

```bash
php artisan migrate
```

### 3. Backfill Existing Data (If Applicable)

If you have existing data, you'll need to set `barangay_id` for existing records. You can do this via a seeder or manually:

```php
// Example: Set barangay_id for existing users
User::allBarangays()->whereNull('barangay_id')->update(['barangay_id' => 1]);
```

### 4. Deploy to Multiple Folders

Deploy the application to separate folders, each with its own `.env` file:

```
/htdocs/barangay1/
  ├── .env (BARANGAY_ID=1)
  └── ...

/htdocs/barangay2/
  ├── .env (BARANGAY_ID=2)
  └── ...

/htdocs/barangay3/
  ├── .env (BARANGAY_ID=3)
  └── ...
```

All deployments should point to the same database.

## Features

### Automatic Data Isolation

All models automatically filter queries by `barangay_id`. For example:

```php
// This will only return clearances for the current barangay
$clearances = Clearance::all();

// This will only return users for the current barangay
$users = User::all();
```

### Bypassing the Scope (For Superadmin)

If you need to query across all barangays (e.g., for a superadmin dashboard), use:

```php
// Get all clearances across all barangays
$allClearances = Clearance::allBarangays()->get();

// Get clearances for a specific barangay
$barangay1Clearances = Clearance::forBarangay(1)->get();
```

### Automatic barangay_id Assignment

When creating new records, `barangay_id` is automatically set from the `BARANGAY_ID` environment variable:

```php
// barangay_id is automatically set
$clearance = Clearance::create([
    'name' => 'John Doe',
    // ... other fields
]);
```

## Models with Multi-Tenancy Support

The following models automatically support multi-tenancy:

- Users
- Clearances
- Complaints
- Information
- Announcements
- Todos
- Personal Information
- Items & Item Schedules
- Vehicles & Vehicle Schedules
- Facilities & Facility Schedules
- Lupon Cases & Related Tables
- Blotters
- Complainees
- Incident Reports
- All Category Models (Clearance Types, Announcement Categories, etc.)
- PDF Content Settings

## Important Notes

1. **User Isolation**: Users are scoped by barangay. A user from Barangay 1 cannot see users from Barangay 2.

2. **Settings Isolation**: Categories, clearance types, and PDF content settings are per-barangay. Each barangay can have its own configuration.

3. **Database Sharing**: All barangays share the same database tables, but data is logically separated by `barangay_id`.

4. **Superadmin Access**: If you need cross-barangay access for superadmin users, you'll need to modify queries to use `allBarangays()` scope.

## Troubleshooting

### Issue: Data from other barangays showing up

**Solution**: Check that `BARANGAY_ID` is set correctly in `.env` and that the application has been restarted after changing `.env`.

### Issue: New records not getting barangay_id

**Solution**: Ensure `BARANGAY_ID` is set in `.env` and the value is numeric (e.g., `1`, not `"1"`).

### Issue: Need to query across barangays

**Solution**: Use the `allBarangays()` scope:
```php
$allData = Model::allBarangays()->get();
```

## Migration Order

The migrations should be run in this order:

1. `add_barangay_id_to_users_table`
2. `add_barangay_id_to_clearances_table`
3. `add_barangay_id_to_complaints_table`
4. `add_barangay_id_to_information_table`
5. `add_barangay_id_to_announcements_table`
6. `add_barangay_id_to_todos_table`
7. `add_barangay_id_to_personal_informations_table`
8. `add_barangay_id_to_settings_tables`
9. `add_barangay_id_to_items_and_schedules_tables`
10. `add_barangay_id_to_vehicles_and_facilities_tables`
11. `add_barangay_id_to_lupon_and_blotter_tables`
12. `add_barangay_id_to_incident_reports_table`

All migrations are designed to be safe to run multiple times (they check if columns exist before adding them).

