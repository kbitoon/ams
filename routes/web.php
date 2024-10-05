<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pending;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComplaintTrackingController;



Route::get('/pending', Pending::class)->name('pending');

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

    Route::view('vehicle-listing', 'vehicle-listing')
        ->name('vehicle-listing');
        
    Route::view('driver', 'driver')
        ->name('driver');

    Route::view('vehicle-schedule', 'vehicle-schedule')
        ->name('vehicle-schedule');

    Route::view('/settings/item-category', 'item-category')
        ->name('item-category');
    
    Route::view('item', 'item')
        ->name('item');
    
    Route::view('item-schedule', 'item-schedule')
        ->name('item-schedule');
    
    Route::view('user-management', 'user-management')
        ->name('user-management');
        
    Route::view('settings', 'settings')
        ->name('settings');

    Route::get('/clearancepurposemodal', [App\Http\Controllers\AmsController::class, 'clearancepurposemodal'])->name('clearancepurposemodal');

    Route::get('/clearancepurpose', [App\Http\Controllers\AmsController::class, 'clearancepurpose'])->name('clearancepurpose');
   
    Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('photo.upload');

    Route::post('/complaints/{complaint}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaint.show');


});

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');

    

    Route::view('get-a-clearance', 'clearance')
        ->name('get-a-clearance');

    Route::view('file-a-complaint', 'complaint')
        ->name('file-a-complaint');

    Route::get('/track-complaint', [ComplaintTrackingController::class, 'showTrackForm'])->name('track-complaint');
    Route::post('/track-complaint', [ComplaintTrackingController::class, 'trackComplaint'])->name('track-complaint.submit');

    Route::get('/clearancepurpose', [App\Http\Controllers\AmsController::class, 'clearancepurpose'])->name('clearancepurpose');

    Route::view('information-list', 'information-list')
        ->name('information-list');

});

require __DIR__.'/auth.php';
