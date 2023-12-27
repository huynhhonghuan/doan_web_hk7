<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\Phim;
use App\Models\QuocGia;
use App\Models\TheLoai;
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
}
