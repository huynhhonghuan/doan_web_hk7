<?php

namespace App\Http\Controllers\trangchu;

use App\Http\Controllers\Controller;
use App\Models\BinhLuan;
use App\Models\Truyen_TheLoai;
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
use Exception;
use App\Models\User;
use App\Models\User_VaiTro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Socialite;


class TrangChuController extends Controller
{
    public function home()
    {
        //Thông tin cần thiết cho giao diện
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        // Tạo file json

        $data = json_encode(Truyen::all());
        file_put_contents(public_path('json/truyen.json'), $data);

        return view('trangchu.home', compact('genre', 'country'));
    }
    public function truyen()
    {
        $truyen_head = Truyen::where('khoa', 1)->orderby('id', 'ASC')->limit(6)->get();
        $ids = [];
        foreach ($truyen_head as $key => $item) {
            $ids[] = $item->id;
        }
        $truyenmoinhat = Truyen::where('khoa', 1)->whereNotIn('id', $ids)->orderby('id', 'ASC')->get();

        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        return view('trangchu.truyen', compact('truyen_head', 'truyenmoinhat', 'genre', 'country'));
    }

    public function truyenmota($id)
    {
        $truyen = Truyen::where('id', $id)->where('khoa', 1)->first();
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen->id)->get()->groupBy('chuong');
        $truyenmoinhat = Truyen::whereNot('id', $truyen->id)->orderby('id', 'ASC')->get();
        $binhluan = BinhLuan::where('truyen_id', $truyen->id)->where('khoa', 1)->get();

        $daxem = $truyen->id;

        if (!session()->has($daxem)) {
            $orm = Truyen::find($truyen->id);
            $orm->luotxem = $truyen->luotxem + 1;
            $orm->save();
            session()->put($daxem, 1);
        }

        return view('trangchu.truyenmota', compact('truyen', 'truyenchitiet', 'truyenmoinhat', 'genre', 'country', 'binhluan'));
    }
    public function truyenxem($slug, $chuong)
    {
        $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
        $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();

        //$truyen = Truyen::where('slug', $slug)->paginate(1);

        $truyen_slug = Truyen::where('slug', $slug)->first();
        $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen_slug->id)->where('chuong', $chuong)->get();
        $truyen_chuong = TruyenChiTiet::all()->groupBy('chuong');
        return view('trangchu.truyenxem', compact('genre', 'country', 'truyen_slug', 'truyenchitiet', 'truyen_chuong'));
    }

    public function binhluantruyen(Request $request, $id)
    {
        try {
            $request->validate([
                'binhluan' => ['required'],
            ]);
            $binhluan = new BinhLuan();
            $binhluan->truyen_id = $id;
            $binhluan->user_id = Auth::user()->id;
            $binhluan->noidung = $request->binhluan;
            $binhluan->save();
        } catch (Exception $e) {
            Session::flash('error', 'Xóa lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->refresh();
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
        //truyện
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            $truyen = Truyen::where('tentruyen', 'LIKE', '%' . $search . '%')->where('khoa', 1)->first();

            if ($truyen) {
                $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
                $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
                $truyenchitiet = TruyenChiTiet::where('truyen_id', $truyen->id)->get()->groupBy('chuong');
                $truyenmoinhat = Truyen::whereNot('id', $truyen->id)->orderby('id', 'ASC')->get();

                $daxem = $truyen->id;

                if (!session()->has($daxem)) {
                    $orm = Truyen::find($truyen->id);
                    $orm->luotxem = $truyen->luotxem + 1;
                    $orm->save();
                    session()->put($daxem, 1);
                }

                return view('trangchu.truyenmota', compact('truyen', 'truyenchitiet', 'truyenmoinhat', 'genre', 'country'));
            }
        }

        //phim
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
    public function loc()
    {
        $sapxep = $_GET['order'];
        $genre_filter = $_GET['genre'];
        $country_filter = $_GET['country'];
        if ($sapxep == '' && $genre_filter == '' && $country_filter == '') {
            return redirect()->back();
        } else {
            $category = DanhMuc::orderby('id', 'ASC')->where('khoa', 1)->get();
            $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
            $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
            $movie_hot = Phim::where('phimhot', 1)->where('khoa', 1)->get();
            $movie_trailersidebar = Phim::where('chatluong', 2)->where('khoa', 1)->take(15)->get();
            //lay phim
            $movie_array = Phim::withCount('tapphim');
            if ($country_filter) {
                $movie_array = $movie_array->where('quocgia_id', $country_filter);
            }
            if ($sapxep == 'name_a_z') {
                $movie_array = $movie_array->orderBy('id', 'ASC');
            }
            if ($sapxep == 'date') {
                $movie_array = $movie_array->orderBy('created_at', 'ASC');
            }
            if ($sapxep == 'year_release') {
                $movie_array = $movie_array->orderBy('nam', 'DESC');
            }

            $movie_array = $movie_array->with('phim_theloai');
            $movie = array();
            $many_genre = [];
            $movieGenreIds = Phim_TheLoai::with('danhmuc', 'phim_theloai', 'quocgia')->where('theloai_id', $genre_filter)->pluck('theloai_id')->toArray();
            if (!empty($movieGenreIds)) {
                $relatedMovieIds = Phim_TheLoai::whereIn('theloai_id', $movieGenreIds)
                    ->pluck('phim_id')
                    ->toArray();

                $many_genre = array_unique($relatedMovieIds);
            } else {
                $many_genre = [];
            }
            if ($country_filter == '' && $genre_filter == '') {
                return redirect()->back();
                $movie = $movie_array->paginate(40);
            } else {
                $movie = $movie_array->whereIn('id', $many_genre);
                $movie =  $movie_array->orWhere('quocgia_id', $country_filter);
                $movie = $movie_array->paginate(40);
            }
            return view('trangchu.loc', compact('category', 'genre', 'country', 'movie_hot', 'movie_trailersidebar', 'movie'));
        }
    }
    public function loctruyen()
    {
        $sapxep = $_GET['order'];
        $genre_filter = $_GET['genre'];
        $country_filter = $_GET['country'];
        if ($sapxep == '' && $genre_filter == '' && $country_filter == '') {
            return redirect()->back();
        } else {
            $genre = TheLoai::orderby('id', 'ASC')->where('khoa', 1)->get();
            $country = QuocGia::orderby('id', 'ASC')->where('khoa', 1)->get();
            //lay truyện
            $truyen_array = Truyen::where('khoa', 1);

            if ($country_filter) {
                $truyen_array = $truyen_array->where('quocgia_id', $country_filter);
            }
            if ($genre_filter) {
                $tr = Truyen_TheLoai::where('theloai_id', $genre_filter)->pluck('truyen_id')->toArray();
                $truyen_array = $truyen_array->whereIn('id', $tr);
            }
            if ($sapxep == 'name_a_z') {
                $truyen_array = $truyen_array->orderBy('id', 'ASC');
            }
            if ($sapxep == 'date') {
                $truyen_array = $truyen_array->orderBy('created_at', 'ASC');
                // dd($truyen_array);
            }
            if ($sapxep == 'year_release') {
                $truyen_array = $truyen_array->orderBy('nam', 'DESC');
            }

            $truyen = array();

            $truyen = $truyen_array->paginate(40);

            $truyenmoinhat = Truyen::where('khoa', 1)->whereNotIn('id', $truyen_array->pluck('id')->toArray())->orderby('id', 'ASC')->limit(6)->get();

            return view('trangchu.loctruyen', compact('genre', 'country', 'truyen', 'truyenmoinhat'));
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->route('homepage');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'username' => 'a',
                    'facebook_id' => $user->id,
                    'password' => encrypt('123456789')
                ]);
                $vaitro = new User_VaiTro();
                $vaitro->user_id = $newUser->id;
                $vaitro->vaitro_id = 'nd';
                $vaitro->save();

                Auth::login($newUser);

                return redirect()->route('homepage');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->stateless()
                ->user();
        } catch (Exception $e) {
            return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
        }

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // Nếu người dùng đã tồn tại thì đăng nhập
            Auth::login($existingUser, true);
            return redirect()->route('user.home');
        } else {
            // Nếu chưa tồn tại người dùng thì thêm mới
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'username' => Str::before($user->email, '@'),
                'password' => Hash::make('123456'), // Gán mật khẩu tự do
            ]);

            $vaitro = new User_VaiTro();
            $vaitro->user_id = $newUser->id;
            $vaitro->vaitro_id = 'nd';
            $vaitro->save();

            // Sau đó đăng nhập
            Auth::login($newUser, true);
            return redirect()->route('homepage');
        }
    }
}
