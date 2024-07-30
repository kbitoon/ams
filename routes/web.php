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

    Route::view('complaint', 'complaint')
        ->name('complaint');

    Route::view('complaint-category', 'complaint-category')
        ->name('complaint-category');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::view('information', 'information')
        ->name('information');

    Route::view('information-category', 'information-category')
        ->name('information-category');

<<<<<<< HEAD
    Route::view('vehicle-listing', 'vehicle-listing')
        ->name('vehicle-listing');
        
    Route::view('driver', 'driver')
        ->name('driver');

    Route::view('vehicle-schedule', 'vehicle-schedule')
        ->name('vehicle-schedule');
=======
    Route::get('/clearancepurposemodal', [App\Http\Controllers\AmsController::class, 'clearancepurposemodal'])->name('clearancepurposemodal');
>>>>>>> 73cfb3f93e1018d237f42019f79a3f4444012426

    Route::get('/clearancepurpose', [App\Http\Controllers\AmsController::class, 'clearancepurpose'])->name('clearancepurpose');
});

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');

    Route::view('get-a-clearance', 'clearance')
        ->name('get-a-clearance');

    Route::view('file-a-complaint', 'complaint')
        ->name('file-a-complaint');

    Route::get('/clearancepurpose', [App\Http\Controllers\AmsController::class, 'clearancepurpose'])->name('clearancepurpose');

    Route::view('information-list', 'information-list')
        ->name('information-list');

});

require __DIR__.'/auth.php';
