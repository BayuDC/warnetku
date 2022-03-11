<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TransactionController;

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
    Route::get('/computer/create', [ComputerController::class, 'create']);
    Route::post('/computer', [ComputerController::class, 'store']);
    Route::get('/computer/{computer:id}', [ComputerController::class, 'show']);
    Route::get('/computer/{computer:id}/edit', [ComputerController::class, 'edit']);
    Route::put('/computer/{computer:id}', [ComputerController::class, 'update']);
    Route::delete('/computer/{computer:id}', [ComputerController::class, 'destroy']);

    Route::get('/price', [PriceController::class, 'index']);
    Route::get('/price/create', [PriceController::class, 'create']);
    Route::post('/price', [PriceController::class, 'store']);
    Route::get('/price/{rental:id}', [PriceController::class, 'show']);
    Route::get('/price/{rental:id}/edit', [PriceController::class, 'edit']);
    Route::put('/price/{rental:id}', [PriceController::class, 'update']);
    Route::delete('/price/{rental:id}', [PriceController::class, 'destroy']);

    Route::get('/operator', [OperatorController::class, 'index']);
    Route::get('/operator/create', [OperatorController::class, 'create']);
    Route::post('/operator', [OperatorController::class, 'store']);
    Route::get('/operator/{operator:username}', [OperatorController::class, 'show']);
    Route::get('/operator/{operator:username}/edit', [OperatorController::class, 'edit']);
    Route::put('/operator/{operator:id}', [OperatorController::class, 'update']);
    Route::delete('/operator/{operator:id}', [OperatorController::class, 'destroy']);

    Route::get('/transaction', [TransactionController::class, 'index']);
    Route::get('/transaction/create', [TransactionController::class, 'create']);
    Route::post('/transaction', [TransactionController::class, 'store']);
    Route::get('/transaction/{transaction:id}', [TransactionController::class, 'show']);
    Route::get('/transaction/{transaction:id}/edit', [TransactionController::class, 'edit']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
