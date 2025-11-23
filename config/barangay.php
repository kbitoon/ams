<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Barangay Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration is used for multi-tenancy support. Each deployment
    | should have a unique BARANGAY_ID in the .env file to isolate data.
    |
    */

    'id' => env('BARANGAY_ID', null),
    'name' => env('BARANGAY_NAME', 'Barangay'),
];

