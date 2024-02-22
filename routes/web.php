<?php

use App\Livewire\Pages\Kegiatan\KegiatanAll;
use App\Livewire\Pages\Kegiatan\KegiatanSingle;
use App\Livewire\Pages\Layanans\SingleLayanan;
use App\Livewire\Pages\Peta\PetaSekolah;
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

Route::view('/', 'welcome')->name('welcome');

Route::view('/layanan', 'layanan')->name('layanan');
Route::get('/layanan/{slug}', SingleLayanan::class)->name('layanan.single');

Route::get('/peta-sekolah', PetaSekolah::class)->name('peta.sekolah');

Route::get('/kegiatan', KegiatanAll::class)->name('kegiatan');
Route::get('/kegiatan/{slug}', KegiatanSingle::class)->name('kegiatan.single');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
