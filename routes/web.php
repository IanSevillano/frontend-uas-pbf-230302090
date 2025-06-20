<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien;
use App\Http\Controllers\Obat;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien', [Pasien::class, 'index'])->name('pasien.index');
Route::get('/pasien/create', [Pasien::class, 'create'])->name('pasien.create');
Route::post('/pasien', [Pasien::class, 'store'])->name('pasien.store');
Route::get('/pasien/{id}/edit', [Pasien::class, 'edit'])->name('pasien.edit');
Route::put('/pasien/{id}', [Pasien::class, 'update'])->name('pasien.update');
Route::delete('/pasien/{id}', [Pasien::class, 'destroy'])->name('pasien.destroy');

Route::get('/obat', [Obat::class, 'index'])->name('obat.index');
Route::get('/obat/create', [Obat::class, 'create'])->name('obat.create');
Route::post('/obat', [Obat::class, 'store'])->name('obat.store');
Route::get('/obat/{id}/edit', [Obat::class, 'edit'])->name('obat.edit');
Route::put('/obat/{id}', [Obat::class, 'update'])->name('obat.update');
Route::delete('/obat/{id}', [Obat::class, 'destroy'])->name('obat.destroy');