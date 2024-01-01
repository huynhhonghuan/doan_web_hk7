<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\Phim;
use App\Models\Phim_TheLoai;
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
        $category_home = DanhMuc::with(['phim' => function ($test) {
            $test->withCount('tapphim');
        }])->orderby('id', 'DESC')->where('khoa', 1)->get();
        return view('trangchu.home', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }

    public function getTruyen()
    {
        $truyen = Truyen::where('khoa', 1)->orderby('id', 'asc')->limit(12)->get();
        $truyenmoinhat = Truyen::where('khoa', 1)->orderby('id', 'asc')->limit(10)->get();
        return view('trangchu.truyen', compact('truyen', 'truyenmoinhat'));
    }
    public function getTruyen_MoTa($id)
    {
        $truyen = Truyen::find($id);
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen->id)->get()->groupBy('chuong');
        $truyenmoinhat = Truyen::orderby('id', 'asc')->limit(4)->get();
        return view('trangchu.truyen_mota', compact('truyen', 'truyenchitiet', 'truyenmoinhat'));
    }
    public function getTruyen_Chuong($id, $chuong)
    {
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $id)->where('chuong', $chuong)->get();
        //dd($truyenchitiet);
        return view('trangchu.truyen_chuong', compact('truyenchitiet'));
    }
    public function category($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $cate_slug = DanhMuc::where('slug', $slug)->first();
        $movie = Phim::withCount('tapphim')->where('danhmuc_id', $cate_slug->id)->where('khoa', 1)->paginate(8);
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        return view('layouts.trangchu.danhmuc', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_trailersidebar'));
    }
    public function genre($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $cate_slug = DanhMuc::where('slug', $slug)->first();
        $genre_slug = TheLoai::where('slug', $slug)->first();
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        //nhieu the loai
        $movie_genre = Phim_TheLoai::where('theloai_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $gen) {
            $many_genre[] = $gen->phim_id;
        }
        $movie = Phim::withCount('tapphim')->whereIn('id', $many_genre)->where('khoa', 1)->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_trailersidebar'));
    }
    public function country($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $cate_slug = DanhMuc::where('slug', $slug)->first();
        $country_slug = QuocGia::where('slug', $slug)->first();
        $movie = Phim::withCount('tapphim')->with('danhmuc', 'phim_theloai', 'quocgia')->where('quocgia_id', $country_slug->id)->where('khoa', 1)->paginate(8);
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_trailersidebar'));
    }
    public function phim()
    {
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $category_home = DanhMuc::with(['phim' => function ($test) {
            $test->withCount('tapphim');
        }])->orderby('id', 'DESC')->where('khoa', 1)->get();
        return view('layouts.trangchu.phim', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }
}
