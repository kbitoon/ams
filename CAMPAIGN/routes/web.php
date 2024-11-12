<?php

use Illuminate\Support\Facades\Route;

Route::prefix('campaign')->group(function () {


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('activity', 'activity')
        ->name('activity');

    Route::view('barangay-list', 'barangay-list')
        ->name('barangay-list');

    Route::view('candidate', 'candidate')
        ->name('candidate');

    Route::view('survey', 'survey')
        ->name('survey');

    Route::view('campaign-iq', 'campaign-iq')
       ->name('campaign-iq');
    Route::view('settings', 'settings')
       ->name('settings');
});

Route::middleware('guest')->group(function () {
    Route::view('/', 'campaign-iq')->name('home');  

    Route::view('answer-a-survey', 'survey')
        ->name('answer-a-survey');

    Route::view('new-supporter', 'campaign-iq')
        ->name('new-supporter');

});
});

require __DIR__.'/auth.php';
