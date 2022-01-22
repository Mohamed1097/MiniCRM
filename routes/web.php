<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['register' => false,'reset' => false]);
Route::group(['middleware'=>['auth','PreventBackHistory']],function(){
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::resource('companies',CompanyController::class);
    Route::resource('contacts',ContactController::class);
    Route::resource('users',UserController::class);
    Route::get('change-password',[UserController::class,'changePassword'])->name('change-password');
    Route::post('change-password',[UserController::class,'setNewPassword'])->name('set-new-password');
});




