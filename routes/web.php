<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

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
    })->name('home');

    Route::resource('computer', ComputerController::class)->scoped([
        'computer' => 'id'
    ]);

    Route::resource('price', PriceController::class)
        ->parameters([
            'price' => 'rental'
        ])->scoped([
            'rental' => 'id'
        ]);

    Route::resource('operator', OperatorController::class)->except(['show', 'edit'])->scoped([
        'operator' => 'id'
    ]);
    Route::resource('operator', OperatorController::class)->only(['show', 'edit'])->scoped([
        'operator' => 'username'
    ]);

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/all', [TransactionController::class, 'indexAll'])->name('all');
        Route::patch('/{transaction:id}/extend', [TransactionController::class, 'extend'])->name('extends');
        Route::resource('/', TransactionController::class)->parameters([
            '' => 'transaction'
        ])->scoped([
            'transaction' => 'id'
        ]);
    });


    Route::prefix('me')->name('me.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('/change-password', [ProfileController::class, 'editPassword'])->name('edit-password');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/change-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    });

    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth');
});
