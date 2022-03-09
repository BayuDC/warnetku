<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\OperatorController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/computer', [ComputerController::class, 'index']);
    Route::get('/computer/add', [ComputerController::class, 'add']);
    Route::get('/computer/edit/{computer:id}', [ComputerController::class, 'edit']);
    Route::get('/computer/{computer:id}', [ComputerController::class, 'detail']);
    Route::post('/computer', [ComputerController::class, 'create']);
    Route::put('/computer/{computer:id}', [ComputerController::class, 'update']);
    Route::delete('/computer/{computer:id}', [ComputerController::class, 'delete']);

    Route::get('/price', [PriceController::class, 'index']);
    Route::get('/price/add', [PriceController::class, 'add']);
    Route::get('/price/edit/{rental:id}', [PriceController::class, 'edit']);
    Route::get('/price/{rental:id}', [PriceController::class, 'detail']);
    Route::post('/price', [PriceController::class, 'create']);
    Route::put('/price/{rental:id}', [PriceController::class, 'update']);
    Route::delete('/price/{rental:id}', [PriceController::class, 'delete']);

    Route::get('/operator', [OperatorController::class, 'index']);
    Route::get('/operator/{operator:username}', [OperatorController::class, 'detail']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
