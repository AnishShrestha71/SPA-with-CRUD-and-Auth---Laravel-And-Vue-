<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TelephoneController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});

Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[LoginController::class, 'login']);
Route::post('logout',[LoginController::class, 'logout']);

Route::post('store',[TelephoneController::class,'store']);
Route::put('update/{telephone}',[TelephoneController::class,'update']);
Route::get('index',[TelephoneController::class,'index']);
Route::get('show/{telephone}',[TelephoneController::class,'show']);
Route::delete('delete/{telephone}',[TelephoneController::class,'delete']);