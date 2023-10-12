<?php

use App\Livewire\Pages\Sekolahs\Sekolah;
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

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    // Profile Pages
    Route::view('profile', 'profile')->name('profile');

    Route::middleware(['verified'])->group(function () {
        // Dashboard Pages
        Route::view('dashboard', 'dashboard')->name('dashboard');

        // Sekolah Pages
        Route::get('/sekolahs', Sekolah::class)->name('sekolah.all');
    });
});

require __DIR__ . '/auth.php';
