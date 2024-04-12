<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CateloryController;

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


Route::group( [ 'prefix' => 'auth', 'as' => 'auth.' ], function () {
    Route::get('/login', function () { return view('pages.login'); }  )->name("login");
    Route::post('/login', [ AuthController::class, 'login' ]  )->name("login");
} );

Route::group( [ 'middleware' => 'auth' ], function () {
    Route::get('/', [ CateloryController::class, 'index' ] )->name("home");

    Route::group( [ 'prefix' => 'Catelory', 'as' => 'catelory' ], function () {
        Route::post('/', [ CateloryController::class, 'create' ]  )->name(".create");
        Route::post('/update/{id}', [ CateloryController::class, 'update' ]  )->name(".update");
        Route::post('/delete/{id}', [ CateloryController::class, 'destroy' ]  )->name(".delete");
    });

});
