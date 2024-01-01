<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        $phimdang = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa',1)->orderBy('id', 'DESC')->count();
        $phimcho = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa',0)->orderBy('id', 'DESC')->count();
        return view('admin.home', compact('title','phimdang','phimcho'));
    }
}
