<?php

use App\Http\Controllers\trangchu\TrangChuController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Truyen\TruyenChiTietController;
use App\Http\Controllers\Admin\Truyen\TruyenController;
use App\Http\Controllers\Admin\Phim\PhimController;
use App\Http\Controllers\admin\phim\TapPhimController;
use App\Http\Controllers\Admin\Taikhoan\TaiKhoanController;
use App\Http\Controllers\Admin\Taikhoan\VaiTroController;
use App\Http\Controllers\admin\Thuvien\DanhMucController;
use App\Http\Controllers\Admin\Thuvien\QuocGiaController;
use App\Http\Controllers\Admin\Thuvien\TacGiaController;
use App\Http\Controllers\Admin\Thuvien\TheLoaiController;
use App\Http\Controllers\Congtacvien\Congtacvienphim\CongTacVienPhimController;
use App\Http\Controllers\congtacvien\congtacvienphim\PhimController as CongtacvienphimPhimController;
use App\Http\Controllers\congtacvien\congtacvienphim\TapPhimController as CongtacvienphimTapPhimController;
use App\Http\Controllers\Congtacvien\Congtacvientruyen\CongTacVienTruyenController;
use App\Http\Controllers\Congtacvien\Congtacvientruyen\TruyenController as ctvt_truyen;
use App\Http\Controllers\Congtacvien\Congtacvientruyen\TruyenChiTietController as ctvt_truyenct;
use App\Http\Middleware\CongTacVienPhimMiddleware;

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

// Route::get('/', function () {
//     return view('trangchu.home');
// });
Route::get('/', [TrangChuController::class, 'home'])->name('homepage');
Route::get('/phims', [TrangChuController::class, 'phim'])->name('phim');
Route::get('/danh-muc/{slug}', [TrangChuController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [TrangChuController::class, 'theloai'])->name('genre');
Route::get('/quoc-gia/{slug}', [TrangChuController::class, 'quocgia'])->name('country');
Route::get('/phim/{slug}', [TrangChuController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [TrangChuController::class, 'watch']);
Route::get('/episode', [TrangChuController::class, 'episode'])->name('episode');
Route::get('/tag/{tag}', [TrangChuController::class, 'tag'])->name('tag');
Route::get('/tim-kiem', [TrangChuController::class, 'search'])->name('search');
Route::get('/loc-phim', [TrangChuController::class, 'filter'])->name('filter');
Route::post('/them-danhgia', [TrangChuController::class, 'them_danhgia'])->name('them-danhgia');
Route::get('/loc', [TrangChuController::class, 'loc'])->name('loc');
Route::post('/upload', [TapPhimController::class, 'upload'])->name('uploadvideo');

//truyện
Route::get('/truyen', [TrangChuController::class, 'truyen'])->name('truyen');
Route::get('/truyen/{id}', [TrangChuController::class, 'truyenmota'])->name('truyen_id');
Route::get('/truyen/{slug}/{chuong}', [TrangChuController::class, 'truyenxem'])->name('truyenchitiet');

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

    //tài khoản
    Route::resource('taikhoan', TaiKhoanController::class)->except('show');
    Route::get('taikhoan/khoa/{taikhoan}', [TaiKhoanController::class, 'khoa'])->name('taikhoan.khoa'); //kiểm duyệt
    Route::get('taikhoan/xuat', [TaiKhoanController::class, 'getXuat'])->name('taikhoan.xuat');
    Route::post('taikhoan/nhap', [TaiKhoanController::class, 'postNhap'])->name('taikhoan.nhap');
    Route::get('taikhoan/xoa/{id}', [TaiKhoanController::class, 'getXoa'])->name('taikhoan.xoa');

    //danh mục quốc gia
    Route::resource('quocgia', QuocGiaController::class)->except('show');
    Route::get('quocgia/khoa/{quocgia}', [QuocGiaController::class, 'khoa'])->name('quocgia.khoa'); //kiểm duyệt
    Route::post('quocgia/nhap', [QuocGiaController::class, 'postNhap'])->name('quocgia.nhap'); //nhập excel
    Route::get('quocgia/xuat', [QuocGiaController::class, 'getXuat'])->name('quocgia.xuat'); //xuất excel

    //thể loại
    Route::resource('theloai', TheLoaiController::class)->except('show');
    Route::get('theloai/khoa/{theloai}', [TheLoaiController::class, 'khoa'])->name('theloai.khoa'); //kiểm duyệt
    Route::post('theloai/nhap', [TheLoaiController::class, 'postNhap'])->name('theloai.nhap'); //nhập excel
    Route::get('theloai/xuat', [TheLoaiController::class, 'getXuat'])->name('theloai.xuat'); //xuất excel

    //tác giả
    Route::resource('tacgia', TacGiaController::class)->except('show');
    Route::get('tacgia/khoa/{tacgia}', [TacGiaController::class, 'khoa'])->name('tacgia.khoa'); //kiểm duyệt
    Route::post('tacgia/nhap', [TacGiaController::class, 'postNhap'])->name('tacgia.nhap'); //nhập excel
    Route::get('tacgia/xuat', [TacGiaController::class, 'getXuat'])->name('tacgia.xuat'); //xuất excel

    //vai trò
    Route::resource('vaitro', VaiTroController::class)->except('show');
    Route::post('vaitro/nhap', [VaiTroController::class, 'postNhap'])->name('vaitro.nhap'); //nhập excel
    Route::get('vaitro/xuat', [VaiTroController::class, 'getXuat'])->name('vaitro.xuat'); //xuất excel

    //truyện
    Route::resource('truyen', TruyenController::class)->except('show');
    Route::get('truyen/khoa/{truyen}', [TruyenController::class, 'khoa'])->name('truyen.khoa'); //kiểm duyệt
    Route::post('truyen/nhap', [TruyenController::class, 'postNhap'])->name('truyen.nhap'); //nhập excel
    Route::get('truyen/xuat', [TruyenController::class, 'getXuat'])->name('truyen.xuat'); //xuất excel
    Route::get('truyen/hinh', [TruyenController::class, 'getHinh'])->name('truyen.hinh'); //xuất hình file.zip

    //chi tiết truyện
    Route::resource('truyenchitiet', TruyenChiTietController::class)->except('show');
    Route::post('truyenchitiet/nhap', [TruyenChiTietController::class, 'postNhap'])->name('truyenchitiet.nhap'); //nhập excel
    Route::get('truyenchitiet/xuat', [TruyenChiTietController::class, 'getXuat'])->name('truyenchitiet.xuat'); //xuất excel
    Route::get('truyenchitiet/hinh', [TruyenChiTietController::class, 'getHinh'])->name('truyenchitiet.hinh'); //xuất hình file.zip

    //danh muc
    Route::prefix('danhmuc')->name('danhmuc.')->group(function () {
        Route::get('list', [DanhMucController::class, 'show'])->name('list');
        Route::get('add', [DanhMucController::class, 'create'])->name('add');
        Route::post('add', [DanhMucController::class, 'postcreate'])->name('postadd');
        Route::get('edit/{id}', [DanhMucController::class, 'edit'])->name('edit');
        Route::post('edit', [DanhMucController::class, 'postedit'])->name('postedit');
        Route::get('delete/{id}', [DanhMucController::class, 'delete'])->name('delete');
        Route::post('nhap', [DanhMucController::class, 'postNhap'])->name('nhap'); //nhập excel
        Route::get('xuat', [DanhMucController::class, 'getXuat'])->name('xuat'); //xuất excel
    });

    //phim
    Route::prefix('movie')->name('movie.')->group(function () {
        Route::get('list', [PhimController::class, 'show'])->name('list');
        Route::get('add', [PhimController::class, 'create'])->name('add');
        Route::post('add', [PhimController::class, 'postcreate'])->name('postadd');
        Route::get('edit/{id}', [PhimController::class, 'edit'])->name('edit');
        Route::post('edit', [PhimController::class, 'postedit'])->name('postedit');
        Route::get('delete/{id}', [PhimController::class, 'delete'])->name('delete');
        Route::get('update-year-movie', [PhimController::class, 'update_year'])->name('update_year');
    });

    //tap phim
    Route::prefix('episode')->name('episode.')->group(function () {
        Route::get('list', [TapPhimController::class, 'show'])->name('list');
        Route::get('add/{id}', [TapPhimController::class, 'create'])->name('add');
        Route::post('add', [TapPhimController::class, 'postcreate'])->name('postadd');
        Route::get('edit/{id}', [TapPhimController::class, 'edit'])->name('edit');
        Route::post('edit', [TapPhimController::class, 'postedit'])->name('postedit');
        Route::get('delete/{id}', [TapPhimController::class, 'delete'])->name('delete');
    });
});

//Cộng tác viên truyện
Route::group(['middleware' => ['auth', 'ctvt'], 'prefix' => 'congtacvientruyen', 'as' => 'congtacvientruyen.'], function () {
    //home
    Route::get('/', [CongTacVienTruyenController::class, 'home'])->name('home');
    Route::get('home', [CongTacVienTruyenController::class, 'home'])->name('home');

    //danh mục truyện ctv
    Route::resource('truyen', ctvt_truyen::class)->except('show');
    Route::post('truyen/nhap', [ctvt_truyen::class, 'postNhap'])->name('truyen.nhap'); //nhập excel
    Route::get('truyen/xuat', [ctvt_truyen::class, 'getXuat'])->name('truyen.xuat'); //xuất excel
    Route::get('truyen/hinh', [ctvt_truyen::class, 'getHinh'])->name('truyen.hinh'); //xuất hình file.zip

    //chi tiết truyện
    Route::resource('truyenchitiet', ctvt_truyenct::class)->except('show');
    Route::post('truyenchitiet/nhap', [ctvt_truyenct::class, 'postNhap'])->name('truyenchitiet.nhap'); //nhập excel
    Route::get('truyenchitiet/xuat', [ctvt_truyenct::class, 'getXuat'])->name('truyenchitiet.xuat'); //xuất excel
    Route::get('truyenchitiet/hinh', [ctvt_truyenct::class, 'getHinh'])->name('truyenchitiet.hinh'); //xuất hình file.zip
});

//Cộng tác viên phim
Route::group(['middleware' => ['auth', 'ctvp'], 'prefix' => 'congtacvienphim', 'as' => 'congtacvienphim.'], function () {
    //home
    Route::get('/', [CongTacVienPhimController::class, 'home'])->name('home');
    Route::get('home', [CongTacVienPhimController::class, 'home'])->name('home');

    //phim
    Route::prefix('movie')->name('movie.')->group(function () {
        Route::get('list', [CongtacvienphimPhimController::class, 'show'])->name('list');
        Route::get('add', [CongtacvienphimPhimController::class, 'create'])->name('add');
        Route::post('add', [CongtacvienphimPhimController::class, 'postcreate'])->name('postadd');
        Route::get('edit/{id}', [CongtacvienphimPhimController::class, 'edit'])->name('edit');
        Route::post('edit', [CongtacvienphimPhimController::class, 'postedit'])->name('postedit');
        Route::get('delete/{id}', [CongtacvienphimPhimController::class, 'delete'])->name('delete');
        Route::get('update-year-movie', [CongtacvienphimPhimController::class, 'update_year'])->name('update_year');
    });

    //tap phim
    Route::prefix('episode')->name('episode.')->group(function () {
        Route::get('list', [CongtacvienphimTapPhimController::class, 'show'])->name('list');
        Route::get('add/{id}', [CongtacvienphimTapPhimController::class, 'create'])->name('add');
        Route::post('add', [CongtacvienphimTapPhimController::class, 'postcreate'])->name('postadd');
        Route::get('edit/{id}', [CongtacvienphimTapPhimController::class, 'edit'])->name('edit');
        Route::post('edit', [CongtacvienphimTapPhimController::class, 'postedit'])->name('postedit');
        Route::get('delete/{id}', [CongtacvienphimTapPhimController::class, 'delete'])->name('delete');
    });
});

//Người dùng
Route::group(['middleware' => ['auth', 'nd'], 'prefix' => 'nguoidung', 'as' => 'nguoidung.'], function () {
    //home
    Route::get('home', [AdminController::class, 'home'])->name('home');
});
