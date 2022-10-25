<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    
    Route::post('/auth/signup', [App\Http\Controllers\AuthController::class, 'signup']);
    Route::post('/auth/signin', [App\Http\Controllers\AuthController::class, 'signin']);

    Route::middleware('jwt.auth')->group(function () {

        Route::get('/profil', [App\Http\Controllers\UserController::class, 'show']);
        Route::post('/tutorial', [App\Http\Controllers\TutorialController::class, 'create']);

    });
 
});


Route::get('/orang', [App\Http\Controllers\apiOrangController::class, 'all']);
Route::post('/orang/add', [App\Http\Controllers\apiOrangController::class, 'add']);
Route::put('/orang/update/{id}', [App\Http\Controllers\apiOrangController::class, 'update']);
Route::delete('/orang/delete/{id}', [App\Http\Controllers\apiOrangController::class, 'delete']);