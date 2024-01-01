<?php

namespace App\Http\Controllers\Congtacvien\Congtacvienphim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CongTacVienPhimController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        return view('congtacvien.congtacvienphim.home', compact('title'));
    }
}
