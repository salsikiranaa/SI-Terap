<?php

use App\Http\Controllers\Manage\mKabupatenController;
use App\Http\Controllers\Manage\mKecamatanController;
use App\Http\Controllers\Manage\mProvinsiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/provinsi', [mProvinsiController::class, 'apiGet']);
Route::get('/kabupaten-provinsi/{provinsi_id}', [mKabupatenController::class, 'apiGetByProvinsi']);
Route::get('/kabupaten', [mKabupatenController::class, 'apiGet']);
Route::get('/kecamatan-kabupaten/{kabupaten_id}', [mKecamatanController::class, 'apiGetByKabupaten']);
Route::get('/kecamatan', [mKecamatanController::class, 'apiGet']);
