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
use App\Models\Truyen;
use App\Models\TruyenChiTiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrangChuController extends Controller
{
    public function home()
    {
        //Thông tin cần thiết cho giao diện
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        return view('trangchu.home', compact('genre', 'country'));
    }
    public function truyen()
    {
        $truyen_head = Truyen::orderby('id', 'ASC')->limit(6)->get();
        $ids = [];
        foreach ($truyen_head as $key => $item) {
            $ids[] = $item->id;
        }
        $truyenmoinhat = Truyen::whereNotIn('id', $ids)->orderby('id', 'ASC')->get();

        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        return view('trangchu.truyen', compact('truyen_head', 'truyenmoinhat', 'genre', 'country'));
    }

    public function truyenmota($id)
    {
        $truyen = Truyen::where('id', $id)->first();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen->id)->get()->groupBy('chuong');
        $truyenmoinhat = Truyen::whereNot('id', $truyen->id)->orderby('id', 'ASC')->get();
        return view('trangchu.truyenmota', compact('truyen', 'truyenchitiet', 'truyenmoinhat', 'genre', 'country'));
    }
    public function truyenxem($id, $chuong)
    {

    }
    //Controller khi chọn 1 danh mục(Phim bộ, phim lẻ,...)
    public function category($slug)
    {
        //Thông tin cần thiết cho giao diện
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //Lấy ra phim hot
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy 1 danh mục theo slug
        $cate_slug = DanhMuc::where('slug', $slug)->first();

        //Lấy phim
        $movie = Phim::withCount('tapphim')->where('danhmuc_id', $cate_slug->id)->where('khoa', 1)->paginate(8);

        //Lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        return view('trangchu.danhmuc', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_trailersidebar', 'movie_hot'));
    }
    public function theloai($slug)
    {
        //Thông tin cần thiết cho giao diện
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //Lấy 1 thể loại theo slug
        $genre_slug = TheLoai::where('slug', $slug)->first();

        //Lấy ra phim hot
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        //Lấy id phim thuộc nhiều thể loại
        $movie_genre = Phim_TheLoai::where('theloai_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $gen) {
            $many_genre[] = $gen->phim_id;
        }
        $movie = Phim::withCount('tapphim')->whereIn('id', $many_genre)->where('khoa', 1)->paginate(40);

        $truyen = Truyen::with('getTheLoai')->where('id', $genre_slug->id)->where('khoa', 1)->paginate(40);

        $ids = [];
        foreach ($truyen as $key => $item) {
            $ids[] = $item->id;
        }
        $truyenmoinhat = Truyen::whereNotIn('id', $ids)->orderby('id', 'ASC')->get();

        return view('trangchu.theloai', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_trailersidebar', 'movie_hot', 'truyen', 'truyenmoinhat'));
    }
    public function quocgia($slug)
    {
        //Thông tin cần thiết cho giao diện
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //Lấy 1 quốc gia theo slug
        $country_slug = QuocGia::where('slug', $slug)->first();

        //Lấy ra phim hot
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy phim thuộc quốc gia đã chọn thông qua slug
        $movie = Phim::withCount('tapphim')->with('danhmuc', 'phim_theloai', 'quocgia')->where('quocgia_id', $country_slug->id)->where('khoa', 1)->paginate(8);

        //Lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        $truyen = Truyen::where('quocgia_id', $country_slug->id)->paginate(40);

        $ids = [];
        foreach ($truyen as $key => $item) {
            $ids[] = $item->id;
        }
        $truyenmoinhat = Truyen::whereNotIn('id', $ids)->orderby('id', 'ASC')->limit(6)->get();

        return view('trangchu.quocgia', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_trailersidebar', 'movie_hot', 'truyen', 'truyenmoinhat'));
    }
    public function phim()
    {
        //Thông tin cần thiết cho giao diện
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //Lấy ra phim hot
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        //Lấy danh mục phim kèm theo số tập phim đã được thêm
        $category_home = DanhMuc::with(['phim' => function ($test) {
            $test->withCount('tapphim');
        }])->orderby('id', 'DESC')->where('khoa', 1)->get();

        return view('trangchu.phims', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_trailersidebar'));
    }

    //Controller khi chọn vào 1 phim
    public function movie($slug)
    {
        //Thông tin cơ bản giao diện cần có
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //Lấy ra 1 phim đã chọn
        $movie = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('slug', $slug)->where('khoa', 1)->first();

        //Lấy ra phim hot
        $movie_hot = Phim::with('danhmuc', 'phim_theloai', 'quocgia', 'danhgiaphim')->withCount('tapphim', 'danhgiaphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy ra id phim thuộc nhiều thể loại
        $many_genre = [];
        $movieGenreIds = Phim_TheLoai::with('danhmuc', 'phim_theloai', 'quocgia')->where('phim_id', $movie->id)->pluck('theloai_id')->toArray();

        //Id thể loại theo id phim thuộc nhiều thể loại
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
        //Phim liên quan
        $movie_related = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('khoa', 1)->whereIn('id', $many_genre)->orWhere('danhmuc_id', $movie->danhmuc->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();

        //lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        //Lấy 3 tập phim mới nhất
        $episode = TapPhim::with('phim')->where('phim_id', $movie->id)->orderBy('tap', 'DESC')->take(3)->get();

        //Lấy ra tập 1 của phim
        $episode_first = TapPhim::with('phim')->where('phim_id', $movie->id)->orderBy('tap', 'ASC')->take(1)->first();

        //Đếm số tập phim đã được thêm
        $episode_cur_list = TapPhim::with('phim')->where('phim_id', $movie->id)->get();
        $episode_cur_list_count = $episode_cur_list->count();

        //Đánh giá cho Phim
        $rating = DanhGiaPhim::where('phim_id', $movie->id)->avg('danhgia');
        $rating = round($rating);
        $count_rating = DanhGiaPhim::where('phim_id', $movie->id)->count();

        //Lượt quan tâm
        $movie->view += 1;
        $movie->save();

        return view('trangchu.phim', compact('category', 'genre', 'country', 'movie', 'movie_related', 'movie_trailersidebar', 'episode', 'episode_first', 'episode_cur_list_count', 'genre_id', 'rating', 'count_rating', 'movie_hot'));
    }
    //Controller khi chọn xem 1 tập phim
    public function watch($slug, $tap)
    {
        //Thông tin cần thiết cho giao diện
        $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $movie = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('slug', $slug)->where('khoa', 1)->first();

        //Lấy ra phim hot
        $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

        //Lấy phim có chất lượng trailer
        $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

        //Lấy ra tập phim đã chọn
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tapphim, 4, 1);
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        }

        //Lấy ra tập phim đã chọn cho phim oneshot
        if (isset($tap) && $tap == 'full') {
            $tapphim = 1;
            $episode = TapPhim::where('phim_id', $movie->id)->where('tap', $tapphim)->first();
        }

        //Lấy id phim thuộc nhiều thể loại
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

        return view('trangchu.xemphim', compact('category', 'genre', 'country', 'movie', 'movie_trailersidebar', 'episode', 'tapphim', 'movie_related', 'movie_hot'));
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

    //Tìm kiếm phim
    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            //Thông tin cần thiết cho giao diện
            $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
            $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
            $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

            //Lấy ra phim hot
            $movie_hot = Phim::withCount('tapphim')->where('phimhot', 1)->where('khoa', 1)->get();

            //Lấy phim có tên tương tự từ khóa
            $movie = Phim::withCount('tapphim')->where('ten', 'LIKE', '%' . $search . '%')->where('khoa', 1)->paginate(40);

            ////Lấy phim có chất lượng trailer
            $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();

            return view('trangchu.timkiem', compact('category', 'genre', 'country', 'search', 'movie', 'movie_trailersidebar', 'movie_hot'));
        } else {
            return redirect()->to('/');
        }
    }
}
