<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\Phim;
use App\Models\QuocGia;
use App\Models\TheLoai;
use App\Models\Truyen;
use App\Models\TruyenChiTiet;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function home()
    {
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $category_home = DanhMuc::with(['phim'=>function($test)
        {
            $test->withCount('tapphim');
        }])->orderby('id', 'DESC')->where('khoa', 1)->get();
        return view('trangchu.home', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }

    public function getTruyen()
    {
        $truyen = Truyen::where('khoa',1)->orderby('id', 'asc')->limit(12)->get();
        $truyenmoinhat = Truyen::where('khoa',1)->orderby('id', 'asc')->limit(10)->get();
        return view('trangchu.truyen', compact('truyen', 'truyenmoinhat'));
    }
    public function getTruyen_Id($id)
    {
        $truyen = Truyen::find($id);
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen->id)->get()->groupBy('chuong');
        $truyenmoinhat = Truyen::orderby('id', 'asc')->limit(4)->get();
        return view('trangchu.truyen_id', compact('truyen','truyenchitiet','truyenmoinhat'));
    }
    public function getTruyenChiTiet($id, $chuong)
    {
        $truyenchitiet = TruyenChiTiet::where('truyen_id',$id)->where('chuong',$chuong)->get();
        //dd($truyenchitiet);
    }
}
