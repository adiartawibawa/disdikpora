<?php

use App\Livewire\Pages\Kegiatan\KegiatanAll;
use App\Livewire\Pages\Kegiatan\KegiatanSingle;
use App\Livewire\Pages\Layanans\SingleLayanan;
use App\Livewire\Pages\Peta\PetaSekolah;
use App\Livewire\Pages\Sekolah\KebutuhanGuru;
use App\Livewire\Users\Layanan\SemuaLayanan;
use App\Livewire\Users\Permohonan\AllPermohonan;
use App\Livewire\Users\Permohonan\CreatePermohonan;
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

Route::get('/kebutuhan-guru', KebutuhanGuru::class)->name('guru.kebutuhan');

Route::get('/kegiatan', KegiatanAll::class)->name('kegiatan');

Route::get('/kegiatan/{slug}', KegiatanSingle::class)->name('kegiatan.single');

Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {

    Route::view('dashboard', 'users.dashboard')->name('user.dashboard');

    Route::get('layanan', SemuaLayanan::class)->name('user.layanan');

    Route::get('permohonan', AllPermohonan::class)->name('user.permohonan');
    Route::get('/permohonan/{slug}/create', CreatePermohonan::class)->name('user.permohonan.create');

    Route::view('profile', 'profile')->name('profile');
});


require __DIR__ . '/auth.php';
