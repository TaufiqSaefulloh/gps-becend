<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\UidController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\UlpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login admin
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Login Admin (form + submit)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

// Alias bawaan Laravel supaya middleware auth() tidak error
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Logout Admin
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Route admin yang terproteksi middleware admin
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // baru
    Route::get('/history', [DashboardController::class, 'history'])->name('user.history');


    // Management User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    // Management User
    Route::resource('users', UserController::class);
    Route::resource('cluster', ClusterController::class);
    Route::resource('uid', UidController::class);
    Route::resource('provinsi', ProvinsiController::class);
    Route::resource('ulp', UlpController::class);
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
});
