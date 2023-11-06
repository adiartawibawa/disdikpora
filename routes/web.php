<?php

use App\Livewire\Pages\Gtks\Gtk;
use App\Livewire\Pages\Panduan\PanduanLayanan;
use App\Livewire\Pages\Sekolahs\ProfileSekolah;
use App\Livewire\Pages\Sekolahs\Sekolah;
use App\Livewire\Pages\Users\AllUser;
use App\Livewire\Pages\Users\FormUser;
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

        // panduan Pages
        Route::get('panduan', PanduanLayanan::class)->name('panduan');

        // Sekolah Pages
        Route::get('/sekolahs', Sekolah::class)->name('sekolah.all');
        Route::get('/sekolahs/{sekolah}/profile', ProfileSekolah::class)->name('sekolah.profile');

        // Gtks Pages
        Route::get('/gtks', Gtk::class)->name('gtk.all');

        // Users Pages
        Route::get('/users', AllUser::class)->name('user.all');
        Route::get('/users/create', FormUser::class)->name('user.create');
        Route::get('/users/{user}/edit', FormUser::class)->name('user.edit');
    });
});

require __DIR__ . '/auth.php';
