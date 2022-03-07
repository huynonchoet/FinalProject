<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\HomestayController;
use App\Http\Controllers\User\RoomController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');


Route::get('/registration', [CustomAuthController::class, 'registration'])->name('register.index');
Route::post('/registration', [CustomAuthController::class, 'customRegistration'])->name('register.create');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::name('user.')->group(function () {

    Route::prefix('/myaccount')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('/update/{id}', [AccountController::class, 'update'])->name('update');
    });

    Route::prefix('/homestays')->name('homestays.')->group(function () {
        Route::get('/', [HomestayController::class, 'index'])->name('index');
        Route::get('/create', [HomestayController::class, 'create'])->name('create');
        Route::post('/', [HomestayController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [HomestayController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [HomestayController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [HomestayController::class, 'destroy'])->name('destroy');

        Route::prefix('/rooms')->name('rooms.')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('index');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::post('/', [RoomController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [RoomController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [RoomController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});
