<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::post('/pegawai/upload-cv', [PegawaiController::class, 'uploadCv'])->name('pegawai.upload-cv');
Route::delete('/pegawai/delete-cv', [PegawaiController::class, 'deleteCv'])->name('pegawai.delete-cv');