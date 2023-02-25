<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => 'auth', 'as' => 'auth.'],function (){
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('signup',[AuthController::class,'signup'])->name('signup');
    Route::post('forgot',[AuthController::class,'forgot'])->name('forgot');
    Route::post('change-password',[AuthController::class,'changePassword'])->name('changePassword');

});

Route::group(['middleware'=> 'auth:sanctum'],function (){

    Route::group(['prefix'=>'me','as'=>'me.'],function (){

        Route::get('/',[UserController::class,'me'])->name('me');

        Route::post('/profile-update',[UserController::class,'profileUpdate'])->name('profileUpdate');
        Route::post('/change-password',[UserController::class,'changePassword'])->name('changePassword');

        Route::group(['prefix'=>'interest','as'=>'interest.'],function (){
            Route::get('/',[InterestController::class,'index'])->name('get');
            Route::post('/add',[InterestController::class,'add'])->name('add');
        });

    });

});
