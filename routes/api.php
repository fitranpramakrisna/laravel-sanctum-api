<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ini adalah route yg akan digunakan, api yg diakses harus melewati auth sanctum/otentikasi dulu disini

Route::group(['middleware' => 'auth:sanctum'], function(){

    // daftar route yg harus melewati otentikasi dulu sebelum bisa dipakai
    Route::get('/show', [FormController::class, 'index']);
    Route::get('/show/{id}', [FormController::class, 'retrieve']);
    Route::get('/delete/{id}', [FormController::class, 'destroy']);
    Route::post('/create', [FormController::class, 'create']);
    Route::post('/update/{id}', [FormController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);