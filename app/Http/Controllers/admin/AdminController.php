<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\Truyen;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        $phimdang = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa', 1)->orderBy('id', 'DESC')->count();
        $phimcho = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa', 0)->orderBy('id', 'DESC')->count();

        $truyendang = Truyen::all()->count();
        $truyenduyet = Truyen::where('khoa', 1)->count();
        $truyenchuaduyet = Truyen::where('khoa', 0)->count();

        //Lấy số lượng của từng loại tài khoản
        $tk_admin = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'admin');
            })
            ->count();
        $tk_ctvt = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'ctvt');
            })
            ->count();
        $tk_ctvp = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'ctvp');
            })
            ->count();
        $tk_nd = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'nd');
            })
            ->count();
        return view('admin.home', compact('title', 'phimdang', 'phimcho', 'truyendang', 'truyenduyet', 'truyenchuaduyet', 'tk_admin', 'tk_ctvt', 'tk_ctvp', 'tk_nd'));
    }
}
