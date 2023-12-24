<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\congtacvien\congtacvienphim\CongTacVienPhimController;
use App\Http\Controllers\congtacvien\congtacvientruyen\CongTacVienTruyenController;
use App\Http\Controllers\trangchu\TrangChuController;
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
    return view('trangchu.home');
});

Auth::routes();

//-------------------------------------Login--------------------------------------------//
Route::get('/login', [LoginController::class, 'login'])->name('login');
//-------------------------------------Login xử lý--------------------------------------------//
Route::post('/login', [LoginController::class, 'login_xuly']);
//-------------------------------------Logout--------------------------------------------//
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Trang chủ
Route::get('/home', [TrangChuController::class, 'home'])->name('home');

//Admin
Route::group(['middleware' => ['auth', 'ad'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //home
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('home', [AdminController::class, 'home'])->name('home');
});

//Cộng tác viên truyện
Route::group(['middleware' => ['auth', 'ctvt'], 'prefix' => 'congtacvientruyen', 'as' => 'congtacvientruyen.'], function () {
    //home
    Route::get('/', [CongTacVienTruyenController::class, 'home'])->name('home');
    Route::get('home', [CongTacVienTruyenController::class, 'home'])->name('home');
});

//Cộng tác viên phim
Route::group(['middleware' => ['auth', 'ctvp'], 'prefix' => 'congtacvienphim', 'as' => 'congtacvienphim.'], function () {
    //home
    Route::get('/', [CongTacVienPhimController::class, 'home'])->name('home');
    Route::get('home', [CongTacVienPhimController::class, 'home'])->name('home');
});

//Người dùng
Route::group(['middleware' => ['auth', 'nd'], 'prefix' => 'nguoidung', 'as' => 'nguoidung.'], function () {
    //home
    Route::get('home', [AdminController::class, 'home'])->name('home');
});
