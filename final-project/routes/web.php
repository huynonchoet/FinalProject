<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\CustomAuthController;
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


Route::get('/registration',[CustomAuthController::class, 'registration'])->name('register.index');
Route::post('/registration',[CustomAuthController::class, 'customRegistration'])->name('register.create');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');