<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('todo', 'todo')
    ->middleware(['auth', 'verified'])
    ->name('todo');

Route::view('clearance', 'clearance')
    ->middleware(['auth', 'verified'])
    ->name('clearance');

Route::view('clearance-type', 'clearance-type')
    ->middleware(['auth', 'verified'])
    ->name('clearance-type');

Route::view('announcement', 'announcement')
    ->middleware(['auth', 'verified'])
    ->name('announcement');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
