<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pending;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComplaintTrackingController;
use App\Http\Controllers\PublicInformationController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\LuponCaseCommentController;
use App\Http\Controllers\LuponEventTrackingController;

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

    Route::view('activity', 'activity')
        ->name('activity');

    Route::view('incident-report', 'incident-report')
        ->name('incident-report');

    Route::view('blotter', 'blotter')
        ->name('blotter');

    Route::view('facility', 'facility')
        ->name('facility');

    Route::view('facility-schedule', 'facility-schedule')
        ->name('facility-schedule');

    Route::view('lupon-case', 'lupon-case')
        ->name('lupon-case');


    // Route::get('/lupon-event-trackings', [LuponEventTrackingController::class, 'index']);
    // Route::get('/lupon-event-trackings/{id}', [LuponEventTrackingController::class, 'getEventDetails']);

    Route::get('/clearancepurposemodal', [App\Http\Controllers\AmsController::class, 'clearancepurposemodal'])->name('clearancepurposemodal');

    Route::get('/clearancepurpose', [App\Http\Controllers\AmsController::class, 'clearancepurpose'])->name('clearancepurpose');
   
    Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('photo.upload');

    Route::post('/luponCases/{luponCase}/luponCaseComments', [LuponCaseCommentController::class, 'store'])->name('luponCaseComments.store');

    Route::post('/complaints/{complaint}/comments', [CommentController::class, 'store'])->name('comments.store');
    // Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaint.show');

    Route::get('/lupon-case/{id}/download', [LuponCaseCommentController::class, 'downloadPdf'])->name('lupon-case.download');
    Route::get('/lupon-summon/{id}/download', [LuponCaseCommentController::class, 'downloadSummonPdf'])->name('lupon-summon.download');
    Route::get('/complainant-summon/{id}/download', [LuponCaseCommentController::class, 'downloadComplainentSummonPdf'])->name('complainant-summon.download');
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
        
    Route::get('/information/{id}', [PublicInformationController::class, 'show'])->name('information.public');

});

Route::middleware(['auth:campaign'])->group(function () {
   
});

require __DIR__.'/auth.php';
