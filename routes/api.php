<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\Kangaroos\KangarooController;
use App\Http\Controllers\Apis\Authentications\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::apiResource('kangaroos', KangarooController::class, [
        'names' => [
            'store' => 'api.post.kangaroos.store',
            'update' => 'api.put.kangaroos.update',
            'destroy' => 'api.delete.kangaroos.destroy'
        ]
    ]);
});