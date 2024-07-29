<?php

use App\Http\Controllers\GeneralPageController;
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

Route::get('/about', function () {
    return view('about');
});

Route::controller(GeneralPageController::class) -> group(function () {
    // Awal Dashboard
    Route::get('/', 'dashboard');
    Route::get('/karya-slb', 'karyaslb');
    Route::get('/tentang-bidang-pembinaan-pendidikan-khusus', 'tentang');
    // Akhir Dashboard
});