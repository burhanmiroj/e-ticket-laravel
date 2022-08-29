<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JadwalPenerbanganController;
use App\Http\Controllers\MaskapaiController;
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
Route::post('/search', [FrontendController::class, 'search'])->name('frontend.search-flight');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/maskapai', MaskapaiController::class);
    Route::resource('/dashboard/penerbangan/jadwal', JadwalPenerbanganController::class);
});

// Route::middleware(['auth', 'role:admin|visitor'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


require __DIR__.'/auth.php';
