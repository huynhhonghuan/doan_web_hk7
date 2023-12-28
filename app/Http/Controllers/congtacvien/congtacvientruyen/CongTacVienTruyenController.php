<?php

namespace App\Http\Controllers\Congtacvien\Congtacvientruyen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CongTacVienTruyenController extends Controller
{
    public function home()
    {
        $title = 'Trang Cộng tác viên';
        return view('congtacvien.congtacvientruyen.home', compact('title'));
    }
}
