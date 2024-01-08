<?php

namespace App\Http\Controllers\Congtacvien\Congtacvientruyen;

use App\Http\Controllers\Controller;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongTacVienTruyenController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        $truyendadang = Truyen::where('user_id',Auth::user()->id)->count();
        $truyenchoduyet = Truyen::where('user_id',Auth::user()->id)->where('khoa', 0)->count();
        $truyenduocduyet = Truyen::where('user_id',Auth::user()->id)->where('khoa', 1)->count();

        // //Lấy số lượng của từng loại tài khoản
        // $tk_truyendadang = Truyen::with('getdaduyet')
        //     ->whereHas('getdaduyet', function ($query) {
        //         $query->where('dadang.id', 'truyen');
        //     })
        // ->count();
        return view('congtacvien.congtacvientruyen.home', compact('title', 'truyendadang','truyenchoduyet','truyenduocduyet'));
    }
}
