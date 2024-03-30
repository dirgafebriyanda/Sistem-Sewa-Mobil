<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardCarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardRentalController;
use App\Http\Controllers\DashboardReturnController;
use App\Http\Controllers\DashboardUserController;
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
    return view('welcome');
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
    Route::resource('/user', DashboardUserController::class)
    ->names('user')
    ->middleware('role:Admin');
    Route::resource('/car', DashboardCarController::class)->names('car');
    
    Route::get('/rental', [DashboardRentalController::class, 'index'])->name('rental.index');
    Route::get('/rental/{car_id}/create', [DashboardRentalController::class, 'create'])->name('rental.create');
    Route::post('/rental/store', [DashboardRentalController::class, 'store'])->name('rental.store');


    Route::resource('/return', DashboardReturnController::class)->names('return');
    Route::post('/return/store', [DashboardReturnController::class,'store'])->name('return.store');
    Route::get('/check', [DashboardReturnController::class,'check'])->name('return.check');
    Route::get('/verifikasi', [DashboardReturnController::class,'verifikasi'])->name('return.verifikasi');
});

