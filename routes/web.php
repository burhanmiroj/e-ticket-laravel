<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JadwalPenerbanganController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::post('/search-flight', [FrontendController::class, 'search'])->name('frontend.search');
Route::post('/booking/create-ticket', [OrderController::class, 'store'])->name('frontend.booking');
Route::post('/booking/check-status', [OrderController::class, 'cekBooking'])->name('frontend.cek-booking');
Route::post('/booking/checkin', [OrderController::class, 'checkin'])->name('frontend.cekin');
Route::get('/booking/create-ticket/success/print-pdf', [OrderController::class, 'print'])->name('frontend.print-ticket');
Route::get('/bp', function() {
    return view('print.e-ticket');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/maskapai', MaskapaiController::class);
    Route::resource('/dashboard/penerbangan/jadwal', JadwalPenerbanganController::class);
});

require __DIR__.'/auth.php';
