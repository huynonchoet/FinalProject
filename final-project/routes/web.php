<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TypeRoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\CaptchaValidationController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\BookingLandlordController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\HomestayController;
use App\Http\Controllers\User\RoomController;
use App\Http\Controllers\User\StatisticController;
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
Route::patch('/confirm-email', [CustomAuthController::class, 'confirmEmail'])->name('confirm-email.update');
Route::get('/reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::name('user.')->group(function () {

    Route::prefix('/myaccount')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('/update/{id}', [AccountController::class, 'update'])->name('update');
    });

    Route::middleware('user')->prefix('/homestays')->name('homestays.')->group(function () {
        Route::get('/', [HomestayController::class, 'index'])->name('index');
        Route::get('/create', [HomestayController::class, 'create'])->name('create');
        Route::post('/', [HomestayController::class, 'store'])->name('store');
        Route::get('/{id}', [HomestayController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [HomestayController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [HomestayController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [HomestayController::class, 'destroy'])->name('destroy');
        Route::post('/report/{id}', [HomestayController::class, 'createReport'])->name('create.report');
        Route::post('/rate/{id}', [HomestayController::class, 'createRate'])->name('create.rate');

        Route::prefix('/rooms')->name('rooms.')->group(function () {
            Route::get('/{homestayId}/create', [RoomController::class, 'create'])->name('create');
            Route::post('/{homestayId}', [RoomController::class, 'store'])->name('store');
            Route::get('/{roomId}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::patch('/{roomId}', [RoomController::class, 'update'])->name('update');
            Route::delete('/{roomId}/delete', [RoomController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware('user')->prefix('/booking-landlords')->name('booking-landlords.')->group(function () {
        Route::get('/', [BookingLandlordController::class, 'index'])->name('index');
        Route::get('/search', [BookingLandlordController::class, 'indexSearch'])->name('indexSearch');
        Route::patch('/{id}', [BookingLandlordController::class, 'update'])->name('update');
        Route::get('/{id}', [BookingLandlordController::class, 'show'])->name('show');
    });

    Route::prefix('/type-rooms')->name('type-rooms.')->group(function () {
        Route::post('/', [TypeRoomController::class, 'store'])->name('store');
        Route::get('/request', [TypeRoomController::class, 'request'])->name('request');
    });

    Route::middleware('user')->prefix('/comment')->name('comment.')->group(function () {
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::patch('/{id}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('delete');
        Route::post('/report/{id}', [CommentController::class, 'createReport'])->name('create.report');
    });

    Route::get('/statistic', [StatisticController::class, 'statistic'])->name('statistic')->middleware('user');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('index');
    Route::get('/incomes', [DashBoardController::class, 'incomes'])->name('incomes');
    Route::post('/incomes/{id}', [DashBoardController::class, 'updateStatus'])->name('incomes.status');
    Route::post('/incomes/remind/{id}', [DashBoardController::class, 'remind'])->name('incomes.remind');

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/unblock/{id}', [UserController::class, 'unblock'])->name('unblock');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/type-rooms')->name('type-rooms.')->group(function () {
        Route::get('/', [TypeRoomController::class, 'index'])->name('index');
        Route::get('/add', [TypeRoomController::class, 'create'])->name('create');
        Route::post('/', [TypeRoomController::class, 'store'])->name('store');
        Route::patch('/update/{id}', [TypeRoomController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TypeRoomController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/reports')->name('reports.')->group(function () {
        Route::get('/comments', [ReportController::class, 'comment'])->name('comments.index');
        Route::post('/comments/{id}', [ReportController::class, 'handleComment'])->name('comments.handle');
        Route::post('/blockComments/{id}', [ReportController::class, 'blockComments'])->name('comments.block');
        Route::get('/homestays', [ReportController::class, 'homestay'])->name('homestays.index');
        Route::post('/homestays/{id}', [ReportController::class, 'handleHomestay'])->name('homestays.handle');
    });
});

Route::middleware('user')->prefix('/booking')->name('booking.')->group(function () {
    Route::get('/room/detail/{roomId}', [BookingController::class, 'roomDetail'])->name('room-detail');
    Route::post('/room/check/{roomId}', [BookingController::class, 'check'])->name('check');
    Route::post('/room/booking/{roomId}', [BookingController::class, 'booking'])->name('booking');
    Route::get('/mybooking/list', [BookingController::class, 'show'])->name('test');
    Route::get('/mybooking/checkout', [BookingController::class, 'checkout'])->name('checkout');
    Route::post('/mybooking/cancel', [BookingController::class, 'cancel'])->name('cancel');
    Route::get('/mybooking/history', [BookingController::class, 'history'])->name('history');
});
Route::get('/booking/{homestayId}', [BookingController::class, 'index'])->name('booking.index');

Route::get('/homestays/report/{id}', [HomestayController::class, 'report'])->name('user.homestays.report');
Route::get('/comment/report/{id}', [CommentController::class, 'report'])->name('user.comment.report');
Route::get('/homestays/rate/{id}', [HomestayController::class, 'rate'])->name('user.homestays.rate');
