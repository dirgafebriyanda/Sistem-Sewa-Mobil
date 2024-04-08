<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardCarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardRentalController;
use App\Http\Controllers\DashboardReturnController;
use App\Http\Controllers\DashboardUserController;
use Facade\FlareClient\View;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return View('welcome');
});
Route::get('/home', function () {
    return redirect ('/dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/dashboard', DashboardController::class)->names('dashboard');
    Route::get('/user/show/{id}', [DashboardUserController::class, 'show'])
    ->name('show');
    Route::post('/user/edit/{id}', [DashboardUserController::class, 'update'])
    ->name('update');
    Route::delete('/hapus/{id}', [DashboardUserController::class, 'hapus'])
    ->name('hapus.akun');
    Route::post('/ubah-password/{id}', [DashboardUserController::class, 'ubahPassword'])
    ->name('ubah-password');

    Route::resource('/user', DashboardUserController::class)
    ->names('user')
    ->middleware('role:Admin');

    Route::resource('/car', DashboardCarController::class)->names('car');
    
    Route::get('/rental', [DashboardRentalController::class, 'index'])->name('rental.index');
    Route::get('/rental/{car_id}/create', [DashboardRentalController::class, 'create'])->name('rental.create');
    Route::post('/rental/store', [DashboardRentalController::class, 'store'])->name('rental.store');
    Route::delete('/rental/{car_id}/delete', [DashboardRentalController::class, 'destroy'])->name('rental.destroy');


    Route::resource('/return', DashboardReturnController::class)->names('return');
    Route::post('/return/store', [DashboardReturnController::class,'store'])->name('return.store');
    Route::get('/check', [DashboardReturnController::class,'check'])->name('return.check');
    Route::get('/verifikasi', [DashboardReturnController::class,'verifikasi'])->name('return.verifikasi');
});
