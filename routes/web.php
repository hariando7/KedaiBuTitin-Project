<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard/welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('orders', OrderController::class)->except(['show', 'edit', 'update']);
    Route::get('/orders/report', [OrderController::class, 'report'])->name('orders.report');
    Route::post('/stocks/reset', [StockController::class, 'reset'])->name('stocks.reset');
});
