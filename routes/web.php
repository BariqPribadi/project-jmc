<?php

use App\Http\Controllers\KabupatenController;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProvinsiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned to a controller.
| Make something great!
|
*/

Route::get('/', [PendudukController::class, 'index']);
Route::get('/about', [PendudukController::class, 'about']);
Route::get('/edit/{id}', [PendudukController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [PendudukController::class, 'update'])->name('update');
Route::delete('/{id}', [PendudukController::class, 'destroy'])->name('hapus');
Route::get('/', [PendudukController::class, 'index'])->name('home');
Route::get('/tambah', [PendudukController::class, 'create'])->name('tambah');
Route::post('/tambah', [PendudukController::class, 'store'])->name('store');
Route::get('/getKabupaten/{id}', [PendudukController::class, 'getKabupaten']);
Route::get('/search', [PendudukController::class, 'search'])->name('search');
Route::get('/export', [PendudukController::class, 'export'])->name('export');



Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
Route::get('/provinsi/{id}/edit', [ProvinsiController::class, 'edit'])->name('provinsi.edit');
Route::put('/provinsi/{id}', [ProvinsiController::class, 'update'])->name('provinsi.update');
Route::delete('/provinsi/{id}', [ProvinsiController::class, 'destroy'])->name('provinsi.destroy');
Route::get('/provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi.create');
Route::post('/provinsi/create', [ProvinsiController::class, 'store'])->name('provinsi.store');

Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
Route::get('/kabupaten/{kabupaten}/edit', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
Route::put('/kabupaten/{kabupaten}', [KabupatenController::class, 'update'])->name('kabupaten.update');
Route::delete('/kabupaten/{kabupaten}', [KabupatenController::class, 'destroy'])->name('kabupaten.destroy');
Route::get('/kabupaten/create', [KabupatenController::class, 'create'])->name('kabupaten.create');
Route::post('/kabupaten', [KabupatenController::class, 'store'])->name('kabupaten.store');
