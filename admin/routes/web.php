<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/topup', [App\Http\Controllers\HomeController::class, 'topup']);
    Route::get('/topup/confirm/{id}', [App\Http\Controllers\HomeController::class, 'topupConfirm']);
    Route::get('/topup/cancel/{id}', [App\Http\Controllers\HomeController::class, 'topupCancel']);
    Route::get('/withdraw', [App\Http\Controllers\HomeController::class, 'withdraw']);
    Route::get('/withdraw/confirm/{id}', [App\Http\Controllers\HomeController::class, 'withdrawConfirm']);
    Route::get('/withdraw/cancel/{id}', [App\Http\Controllers\HomeController::class, 'withdrawCancel']);
    Route::get('/report', [App\Http\Controllers\HomeController::class, 'report']);
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'users']);
});
