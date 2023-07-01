<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Kangaroos\KangarooController;
use App\Http\Controllers\Web\Authentications\AuthController;

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

Route::get('/', function(){
    return redirect('/login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('web.post.login');
Route::get('logout', [AuthController::class, 'logout'])->name('web.get.logout');

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::group(['prefix' => 'kangaroos'], function (){
        Route::get('/', [KangarooController::class, 'index'])->name('web.kangaroos.index');
        Route::get('create', [KangarooController::class, 'create'])->name('web.kangaroos.create');
        Route::get('{id}/edit', [KangarooController::class, 'edit'])->name('web.kangaroos.edit');
    });
});
