<?php

use Illuminate\Support\Facades\Route;
use Modules\Cms\App\Http\Controllers\CmsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Route::resource('cms', CmsController::class)->names('cms');
    Route::get('cms/about_us',[CmsController::class,'about_us'])->name('cms.about_us');
    Route::post('submit_about_us',[CmsController::class,'submit_about_us'])->name('cms.submit_about_us');

    Route::get('cms/home',[CmsController::class,'home'])->name('cms.home');
    Route::post('submit_home',[CmsController::class,'submit_home'])->name('cms.submit_home');
});
