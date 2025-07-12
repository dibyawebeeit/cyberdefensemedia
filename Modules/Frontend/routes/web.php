<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\App\Http\Controllers\FrontendController;



Route::group([], function () {
    Route::resource('/', FrontendController::class)->names('frontend');
    Route::get('about', [FrontendController::class, 'about'])->name('about');
    Route::get('news', [FrontendController::class, 'news'])->name('news');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::post('submit_contact', [FrontendController::class, 'submit_contact'])->name('submit_contact');
    Route::post('submit_newsletter', [FrontendController::class, 'submit_newsletter'])->name('submit_newsletter');


    Route::get('newsFeedApi', [FrontendController::class, 'newsFeedApi']);

    // Route::get('test', [FrontendController::class, 'test']);
});
