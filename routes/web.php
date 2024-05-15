<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('todo', 'todo')
        ->name('todo');

    Route::view('clearance', 'clearance')
        ->name('clearance');

    Route::view('clearance-type', 'clearance-type')
        ->name('clearance-type');

    Route::view('announcement', 'announcement')
        ->name('announcement');

    Route::view('announcement-category', 'announcement-category')
        ->name('announcement-category');

    Route::view('profile', 'profile')
        ->name('profile');
});

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome');

    Route::view('get-a-clearance', 'clearance')
        ->name('get-a-clearance');
});

require __DIR__.'/auth.php';
