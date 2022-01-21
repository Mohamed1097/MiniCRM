<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' =>'v1',],function(){
    Route::post('login',[AuthController::class,'login'])->name('login');

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('companies',[MainController::class,'companies']);
    Route::post('add-company',[MainController::class,'addCompany'])->name('companies.store');
    Route::post('edit-company',[MainController::class,'editCompany']);
    Route::get('contacts',[MainController::class,'contacts']);
    Route::post('add-contact',[MainController::class,'addContact'])->name('contacts.store');
    Route::post('edit-contact',[MainController::class,'editContact']);
   
});
    
});

