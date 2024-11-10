<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Kinerja\DiseminasiController;
use App\Http\Controllers\Kinerja\IdentifikasiController;
use App\Http\Controllers\Kinerja\PendampinganController;
use App\Http\Controllers\Lab\RisetController;
use App\Http\Controllers\Manage\AccountsController;
use App\Http\Controllers\Manage\mBSIPController;
use App\Http\Controllers\Manage\mIP2SIPController;
use App\Http\Controllers\Manage\mJenisStandardController;
use App\Http\Controllers\Manage\mKabupatenController;
use App\Http\Controllers\Manage\mKecamatanController;
use App\Http\Controllers\Manage\mKelompokStandardController;
use App\Http\Controllers\Manage\mLembagaController;
use App\Http\Controllers\Manage\mMetodeController;
use App\Http\Controllers\Manage\mProvinsiController;
use App\Http\Controllers\Manage\mSasaranController;
use App\Http\Controllers\Manage\mServiceController;
use App\Http\Controllers\Manage\mSIPController;
use App\Http\Controllers\Penyuluh\PenyuluhController;
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

Route::get('/', [GuestController::class, 'home'])->name('home');


Route::middleware('guest')->prefix('/auth')->group(function () {
    Route::get('/login', function () {return view('auth.login');})->name('auth.login.view');
    Route::get('/register', function () {return 'register view';})->name('auth.register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('authenticated')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::middleware('admin')->prefix('/manage')->group(function () {
        Route::get('/test', function () {
            return view('api-test.index');
        });
        Route::get('/', function () {return 'admin dashboard';})->name('manage.dashboard');
        Route::prefix('/service')->group(function () {
            Route::get('/', [mServiceController::class, 'get'])->name('manage.service.view');
            Route::post('/', [mServiceController::class, 'store'])->name('manage.service.store');
            Route::put('/{id}', [mServiceController::class, 'update'])->name('manage.service.update');
            Route::put('/{id}/lock', [mServiceController::class, 'lock'])->name('manage.service.lock');
            Route::put('/{id}/unlock', [mServiceController::class, 'unlock'])->name('manage.service.unlock');
            Route::delete('/{id}', [mServiceController::class, 'destroy'])->name('manage.service.destroy');
        });
        Route::prefix('/accounts')->group(function () {
            Route::put('/{id}/verify', [AccountsController::class, 'verifyUser'])->name('manage.accounts.verify');
            Route::put('/{id}/unverify', [AccountsController::class, 'unverifyUser'])->name('manage.accounts.unverify');
            Route::put('/{id}/service-access-update', [AccountsController::class, 'serviceAccess'])->name('manage.accounts.service_access_update');
            Route::put('/{id}/set-as-admin', [AccountsController::class, 'setAsAdmin'])->name('manage.accounts.set_as_admin');
            Route::put('/{id}/remove-admin', [AccountsController::class, 'removeAdmin'])->name('manage.accounts.remove_admin');
        });
        Route::prefix('/provinsi')->group(function () {
            Route::get('/', [mProvinsiController::class, 'get'])->name('manage.provinsi.view');
            Route::post('/', [mProvinsiController::class, 'store'])->name('manage.provinsi.store');
            Route::put('/{id}', [mProvinsiController::class, 'update'])->name('manage.provinsi.update');
            Route::delete('/{id}', [mProvinsiController::class, 'destroy'])->name('manage.provinsi.destroy');
        });
        Route::prefix('/kabupaten')->group(function () {
            Route::get('/', [mKabupatenController::class, 'get'])->name('manage.kabupaten.view');
            Route::post('/', [mKabupatenController::class, 'store'])->name('manage.kabupaten.store');
            Route::put('/{id}', [mKabupatenController::class, 'update'])->name('manage.kabupaten.update');
            Route::delete('/{id}', [mKabupatenController::class, 'destroy'])->name('manage.kabupaten.destroy');
        });
        Route::prefix('/kecamatan')->group(function () {
            Route::get('/', [mKecamatanController::class, 'get'])->name('manage.kecamatan.view');
            Route::post('/', [mKecamatanController::class, 'store'])->name('manage.kecamatan.store');
            Route::put('/{id}', [mKecamatanController::class, 'update'])->name('manage.kecamatan.update');
            Route::delete('/{id}', [mKecamatanController::class, 'destroy'])->name('manage.kecamatan.destroy');
        });
        Route::prefix('/bsip')->group(function () {
            Route::get('/', [mBSIPController::class, 'get'])->name('manage.bsip.view');
            Route::post('/', [mBSIPController::class, 'store'])->name('manage.bsip.store');
            Route::put('/{id}', [mBSIPController::class, 'update'])->name('manage.bsip.update');
            Route::delete('/{id}', [mBSIPController::class, 'destroy'])->name('manage.bsip.destroy');
        });
        Route::prefix('/ip2sip')->group(function () {
            Route::get('/', [mIP2SIPController::class, 'get'])->name('manage.ip2sip.view');
            Route::post('/', [mIP2SIPController::class, 'store'])->name('manage.ip2sip.store');
            Route::put('/{id}', [mIP2SIPController::class, 'update'])->name('manage.ip2sip.update');
            Route::delete('/{id}', [mIP2SIPController::class, 'destroy'])->name('manage.ip2sip.destroy');
        });
        Route::prefix('/jenis-standard')->group(function () {
            Route::get('/', [mJenisStandardController::class, 'get'])->name('manage.jenis_standard.view');
            Route::post('/', [mJenisStandardController::class, 'store'])->name('manage.jenis_standard.store');
            Route::put('/{id}', [mJenisStandardController::class, 'update'])->name('manage.jenis_standard.update');
            Route::delete('/{id}', [mJenisStandardController::class, 'destroy'])->name('manage.jenis_standard.destroy');
        });
        Route::prefix('/kelompok-standard')->group(function () {
            Route::get('/', [mKelompokStandardController::class, 'get'])->name('manage.kelompok_standard.view');
            Route::post('/', [mKelompokStandardController::class, 'store'])->name('manage.kelompok_standard.store');
            Route::put('/{id}', [mKelompokStandardController::class, 'update'])->name('manage.kelompok_standard.update');
            Route::delete('/{id}', [mKelompokStandardController::class, 'destroy'])->name('manage.kelompok_standard.destroy');
        });
        Route::prefix('/lembaga')->group(function () {
            Route::get('/', [mLembagaController::class, 'get'])->name('manage.lembaga.view');
            Route::post('/', [mLembagaController::class, 'store'])->name('manage.lembaga.store');
            Route::put('/{id}', [mLembagaController::class, 'update'])->name('manage.lembaga.update');
            Route::delete('/{id}', [mLembagaController::class, 'destroy'])->name('manage.lembaga.destroy');
        });
        Route::prefix('/metode')->group(function () {
            Route::get('/', [mMetodeController::class, 'get'])->name('manage.metode.view');
            Route::post('/', [mMetodeController::class, 'store'])->name('manage.metode.store');
            Route::put('/{id}', [mMetodeController::class, 'update'])->name('manage.metode.update');
            Route::delete('/{id}', [mMetodeController::class, 'destroy'])->name('manage.metode.destroy');
        });
        Route::prefix('/sasaran')->group(function () {
            Route::get('/', [mSasaranController::class, 'get'])->name('manage.sasaran.view');
            Route::post('/', [mSasaranController::class, 'store'])->name('manage.sasaran.store');
            Route::put('/{id}', [mSasaranController::class, 'update'])->name('manage.sasaran.update');
            Route::delete('/{id}', [mSasaranController::class, 'destroy'])->name('manage.sasaran.destroy');
        });
        Route::prefix('/sip')->group(function () {
            Route::get('/', [mSIPController::class, 'get'])->name('manage.sip.view');
            Route::post('/', [mSIPController::class, 'store'])->name('manage.sip.store');
            Route::put('/{id}', [mSIPController::class, 'update'])->name('manage.sip.update');
            Route::delete('/{id}', [mSIPController::class, 'destroy'])->name('manage.sip.destroy');
        });
    });

    Route::middleware('service:1')->prefix('/kinerja-kegiatan')->group(function () {
        Route::prefix('/identifikasi')->group(function () {
            Route::get('/', [IdentifikasiController::class, 'get'])->name('kinerja.identifikasi.view');
            Route::get('/{id}', [IdentifikasiController::class, 'getById'])->name('kinerja.identifikasi.detail');
            Route::post('/', [IdentifikasiController::class, 'store'])->name('kinerja.identifikasi.store');
            Route::put('/{id}', [IdentifikasiController::class, 'update'])->name('kinerja.identifikasi.update');
            Route::delete('/{id}', [IdentifikasiController::class, 'destroy'])->name('kinerja.identifikasi.destroy');
        });
        Route::prefix('/diseminasi')->group(function () {
            Route::get('/', [DiseminasiController::class, 'get'])->name('kinerja.diseminasi.view');
            Route::get('/{id}', [DiseminasiController::class, 'getById'])->name('kinerja.diseminasi.detail');
            Route::post('/', [DiseminasiController::class, 'store'])->name('kinerja.diseminasi.store');
            Route::put('/{id}', [DiseminasiController::class, 'update'])->name('kinerja.diseminasi.update');
            Route::delete('/{id}', [DiseminasiController::class, 'destroy'])->name('kinerja.diseminasi.destroy');
        });
        Route::prefix('/pendampingan')->group(function () {
            Route::get('/', [PendampinganController::class, 'get'])->name('kinerja.pendampingan.view');
            Route::get('/{id}', [PendampinganController::class, 'getById'])->name('kinerja.pendampingan.detail');
            Route::post('/', [PendampinganController::class, 'store'])->name('kinerja.pendampingan.store');
            Route::put('/{id}', [PendampinganController::class, 'update'])->name('kinerja.pendampingan.update');
            Route::delete('/{id}', [PendampinganController::class, 'destroy'])->name('kinerja.pendampingan.destroy');
        });
    });

    Route::middleware('service:2')->prefix('/lab')->group(function () {
        Route::prefix('/riset')->group(function () {
            Route::get('/', [RisetController::class, 'get'])->name('lab.riset.view');
            Route::get('/{id}', [RisetController::class, 'getById'])->name('lab.riset.detail');
            Route::post('/', [RisetController::class, 'store'])->name('lab.riset.store');
            Route::put('/{id}', [RisetController::class, 'update'])->name('lab.riset.update');
            Route::delete('/{id}', [RisetController::class, 'destroy'])->name('lab.riset.destroy');
        });
    });

    Route::middleware('service:5')->prefix('/direktori-penyuluh')->group(function () {
        Route::prefix('/penyuluh')->group(function () {
            Route::get('/', [PenyuluhController::class, 'get'])->name('direktori_penyuluh.penyuluh.view');
            Route::get('/{id}', [PenyuluhController::class, 'getById'])->name('direktori_penyuluh.penyuluh.detail');
            Route::post('/', [PenyuluhController::class, 'store'])->name('direktori_penyuluh.penyuluh.store');
            Route::put('/{id}', [PenyuluhController::class, 'update'])->name('direktori_penyuluh.penyuluh.update');
            Route::delete('/{id}', [PenyuluhController::class, 'destroy'])->name('direktori_penyuluh.penyuluh.destroy');
        });
    });
});

Route::get('/beranda', function () {
    return view('guest.beranda');
});