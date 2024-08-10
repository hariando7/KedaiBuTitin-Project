<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrasmananOrderController;
use App\Http\Controllers\PrasmananStockController;
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
    Route::resource('prasmanan_stocks', PrasmananStockController::class);
    Route::resource('prasmanan_orders', PrasmananOrderController::class);
    Route::put('prasmanan_orders/{prasmananOrder}', [PrasmananOrderController::class, 'update'])->name('prasmanan_orders.update');
    Route::get('/prasmanan_orders/{id}', [PrasmananOrderController::class, 'show'])->name('prasmanan_orders.show');
});

// routes/web.php
Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
