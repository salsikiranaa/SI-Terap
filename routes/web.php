<?php

use App\Http\Controllers\Auth\AuthController;
use App\Models\pServiceAccess;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->prefix('/auth')->group(function () {
    Route::get('/login', function () {return view('auth.login');})->name('auth.login.view');
    Route::get('/register', function () {return 'register view';})->name('auth.register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('authenticated')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::middleware('admin')->prefix('/manage')->group(function () {
        Route::get('/', function () {return 'admin dashboard';})->name('manage.dashboard');
    });
});
