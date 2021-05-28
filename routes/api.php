<?php

use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//auth routes
Route::post('v1/user/auth/register',[RegisterController::class,'register']);
Route::post('v1/user/auth/login',[LoginController::class,'login']);
Route::post('v1/user/auth/forgot',[ForgotController::class,'forgot']);
Route::post('v1/user/auth/reset',[ForgotController::class,'reset']);


Route::middleware('auth:api')->prefix('v1')->group(function (){
//    Route::apiResource('v1/authors',AuthorsController::class);
    Route::get('/user',function (){
        return auth()->user();
    });
});









