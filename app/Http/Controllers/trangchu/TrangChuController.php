<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Models\DanhGiaPhim;
use App\Models\DanhMuc;
use App\Models\Phim;
use App\Models\Phim_TheLoai;
use App\Models\QuocGia;
use App\Models\TapPhim;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function category($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $cate_slug = DanhMuc::where('slug', $slug)->first();
        $movie = Phim::withCount('tapphim')->where('danhmuc_id', $cate_slug->id)->where('khoa', 1)->paginate(8);
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        return view('trangchu.danhmuc', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_trailersidebar'));
    }
    public function theloai($slug)
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
        return view('trangchu.theloai', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_trailersidebar'));
    }
    public function quocgia($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $cate_slug = DanhMuc::where('slug', $slug)->first();
        $country_slug = QuocGia::where('slug', $slug)->first();
        $movie = Phim::withCount('tapphim')->with('danhmuc', 'phim_theloai', 'quocgia')->where('quocgia_id', $country_slug->id)->where('khoa', 1)->paginate(8);
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        return view('trangchu.quocgia', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_trailersidebar'));
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
        return view('trangchu.phims', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }
    public function movie($slug)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        $movie = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('slug', $slug)->where('khoa', 1)->first();

        $many_genre = [];
        $movieGenreIds = Phim_TheLoai::with('danhmuc', 'phim_theloai', 'quocgia')->where('phim_id', $movie->id)->pluck('theloai_id')->toArray();

        $genre_id = TheLoai::whereIn('id', $movieGenreIds)->where('khoa', 1)->get();
        if (!empty($movieGenreIds)) {
            $relatedMovieIds = Phim_TheLoai::whereIn('theloai_id', $movieGenreIds)
                ->where('phim_id', '!=', $movie->id)
                ->pluck('phim_id')
                ->toArray();

            $many_genre = array_unique($relatedMovieIds);
        } else {
            $many_genre = [];
        }


        $movie_related = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('khoa', 1)->whereIn('id', $many_genre)->orWhere('danhmuc_id', $movie->danhmuc->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        $episode = TapPhim::with('phim')->where('phim_id', $movie->id)->orderBy('tap', 'DESC')->take(3)->get();

        $episode_first = TapPhim::with('phim')->where('phim_id', $movie->id)->orderBy('tap', 'ASC')->take(1)->first();

        $episode_cur_list = TapPhim::with('phim')->where('phim_id', $movie->id)->get();
        $episode_cur_list_count = $episode_cur_list->count();

        $rating = DanhGiaPhim::where('phim_id', $movie->id)->avg('danhgia');
        $rating = round($rating);

        $count_rating = DanhGiaPhim::where('phim_id', $movie->id)->count();

        return view('trangchu.phim', compact('category', 'genre', 'country', 'movie', 'movie_related', 'movie_trailersidebar', 'episode', 'episode_first', 'episode_cur_list_count', 'genre_id', 'rating', 'count_rating'));
    }
    public function watch($slug, $tap)
    {
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $movie = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('slug', $slug)->where('khoa', 1)->first();
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tapphim, 4, 1);
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        }

        if (isset($tap) && $tap == 'full') {
            $tapphim = 1;
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        }

        $many_genre = [];
        $movieGenreIds = Phim_TheLoai::with('danhmuc', 'phim_theloai', 'quocgia')->where('phim_id', $movie->id)->pluck('theloai_id')->toArray();

        $genre_id = TheLoai::whereIn('id', $movieGenreIds)->where('khoa', 1)->get();
        if (!empty($movieGenreIds)) {
            $relatedMovieIds = Phim_TheLoai::whereIn('theloai_id', $movieGenreIds)
                ->where('phim_id', '!=', $movie->id)
                ->pluck('phim_id')
                ->toArray();

            $many_genre = array_unique($relatedMovieIds);
        } else {
            $many_genre = [];
        }
        $movie_related = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->whereIn('id', $many_genre)->orWhere('danhmuc_id', $movie->danhmuc->id)->where('khoa', 1)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        return view('trangchu.xemphim', compact('category', 'genre', 'country', 'movie', 'movie_trailersidebar', 'episode', 'tapphim', 'movie_related'));
    }

    public function them_danhgia(Request $request)
    {
        $data = $request->all();
        $ip = $request->ip();
        $rating_count = DanhGiaPhim::where('phim_id', $data['phim_id'])->where('ip', $ip)->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new DanhGiaPhim();
            $rating->phim_id = $data['phim_id'];
            $rating->danhgia = $data['index'];
            $rating->ip = $ip;
            $rating->save();
            echo 'done';
        }
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
            $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
            $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

            $movie = Phim::withCount('tapphim')->where('ten', 'LIKE', '%' . $search . '%')->where('khoa', 1)->paginate(40);

            $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

            return view('trangchu.timkiem', compact('category', 'genre', 'country', 'search', 'movie', 'movie_trailersidebar'));
        } else {
            return redirect()->to('/');
        }
    }
}
