<?php

use Illuminate\Support\Facades\Route;
use Modules\Faq\App\Http\Controllers\FaqController;

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

Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
    Route::resource('faq', FaqController::class)->names('faq');
});
