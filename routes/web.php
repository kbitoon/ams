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
use App\Http\Controllers\CertificateController;


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

    // Relief Monitoring System
    Route::middleware('role:superadmin|administrator|support')->group(function () {
        Route::view('relief-operation', 'relief-operation')
            ->name('relief-operation');
        Route::view('relief-type', 'relief-type')
            ->name('relief-type');
        Route::view('relief-provider', 'relief-provider')
            ->name('relief-provider');
        Route::view('family', 'family')
            ->name('family');
        Route::view('relief-report', 'relief-report')
            ->name('relief-report');
    });

    // Disaster Management System
    Route::middleware('role:superadmin|administrator|support|tanod|lupon')->group(function () {
        Route::view('disaster-management', 'disaster-management')
            ->name('disaster-management');
        Route::view('disaster-type', 'disaster-type')
            ->name('disaster-type');
        Route::view('disaster-alert', 'disaster-alert')
            ->name('disaster-alert');
        Route::view('disaster-monitoring', 'disaster-monitoring')
            ->name('disaster-monitoring');
        Route::view('disaster-report', 'disaster-report')
            ->name('disaster-report');
        Route::view('disaster-recovery', 'disaster-recovery')
            ->name('disaster-recovery');
        Route::view('preparedness-checklist', 'preparedness-checklist')
            ->name('preparedness-checklist');
        Route::view('evacuation-center', 'evacuation-center')
            ->name('evacuation-center');
        Route::view('disaster-response-team', 'disaster-response-team')
            ->name('disaster-response-team');
        Route::view('disaster-resource', 'disaster-resource')
            ->name('disaster-resource');
    });

    // RSS Feed (Public)
    Route::get('/disaster-rss', [App\Http\Controllers\DisasterRssController::class, 'index'])
        ->name('disaster-rss');

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
        ->middleware('role:superadmin|administrator|support')
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


    Route::get('/certificate/{id}/download', [CertificateController::class, 'downloadPdf'])->name('certificate.download');

    Route::get('/indigency/{id}/download', [CertificateController::class, 'indigencyPdf'])->name('indigency.download');
    Route::get('/electrical/{id}/download', [CertificateController::class, 'electricalPdf'])->name('electrical.download');

    // ID Card routes
    Route::get('/id-card/download', [App\Http\Controllers\IDCardController::class, 'download'])
        ->name('id-card.download');
    
    Route::get('/id-card/download/{userId}', [App\Http\Controllers\IDCardController::class, 'downloadForUser'])
        ->middleware('role:superadmin|administrator|support')
        ->name('id-card.download.user');

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

// Public routes (accessible to everyone, authenticated or not)
Route::get('announcement/{id}', function ($id) {
    return view('announcement-view', ['id' => $id]);
})->name('announcement.view');

// Clearance verification route (public)
Route::get('clearance/verify/{token}', [CertificateController::class, 'verify'])->name('clearance.verify');

// ID Card verification route (public)
Route::get('id-card/verify/{token}', [App\Http\Controllers\IDCardController::class, 'verify'])->name('id-card.verify');

// Monitoring Dashboard (public, no authentication required)
Route::get('monitoring', \App\Livewire\MonitoringDashboard::class)->name('monitoring');

Route::middleware(['auth:campaign'])->group(function () {

});

require __DIR__ . '/auth.php';
