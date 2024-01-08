<?php

namespace App\Http\Controllers\Admin\Phim;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\Phim;
use App\Models\QuocGia;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PhimController extends Controller
{
    public function create()
    {
        $title = 'Thêm phim mới';
        $category = DanhMuc::all();
        $genre = TheLoai::all();
        $country = QuocGia::all();
        return view('admin.phims.phim.add', compact('title', 'category', 'genre', 'country'));
    }

    public function postcreate(Request $request)
    {
        $file = $request->image;
        $data = $request->all();
        $dieukien = 0;
        if ($file || $request->linkphim) {
            try {
                $movie = new Phim();
                $movie->ten = $request->input('title');
                $movie->slug = Str::slug($request->input('title'), '-');
                $movie->mota = $request->input('description');
                $movie->khoa = $request->input('status');
                $movie->phimhot = $request->input('movie_hot');
                $movie->chatluong = $request->input('resolution');
                $movie->phude = $request->input('subtitle');
                $movie->thoiluong = $request->input('time');
                if ($request->input('category_id') == 2) {
                    $movie->sotap = 1;
                } else {
                    $movie->sotap = $request->input('episodes');
                }
                $movie->tags = $request->input('tags');
                $movie->trailer = $request->input('trailer');
                $movie->danhmuc_id = $request->input('category_id');
                $movie->nam = '2000';
                $movie->view = 0;
                $movie->quocgia_id = $request->input('country_id');
                $movie->user_id = Auth::user()->id;
                $ext = $request->image->extension();
                $file_name = time() . '-' . 'phim.' . $ext;

                $request->merge(['image/phim' => $file_name]);
                $movie->hinhanh = $file_name;
                $movie->save();

                //nhieu th loai
                $movie->Phim_TheLoai()->attach($data['genre']);

                $dieukien = 1;
                Session::flash('success', 'Thêm Phim thành công');
            } catch (Exception $e) {
                Session::flash('error', 'Nhập lỗi. Vui lòng kiểm tra lại');
                $dieukien = 0;
            }
        } else {
            Session::flash('error', 'Nhập lỗi. Vui lòng kiểm tra lại');
        }
        if ($dieukien == 1) {
            $file->move(public_path('image/phim'), $file_name);
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Phim';
        $movieList = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->orderBy('id', 'DESC')->get();
        $movie = $movieList->where('khoa', 1);
        $path = public_path() . "/json/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'phim.json', json_encode($movie));
        return view('admin.phims.phim.list', compact('title', 'movieList'));
    }

    public function delete($id)
    {
        try {
            $movie = Phim::find($id);
            $Path = 'public/image/phim/' . $movie->hinhanh;
            if (file_exists($Path)) {
                unlink($Path);
            }
            $movie->delete();

            Session::flash('success', 'Xóa Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Xóa lỗi. Vui lòng kiểm tra lại');
        }

        return redirect()->route('admin.movie.list');
    }

    public function edit(Request $request, $id)
    {
        try {
            $movieEdit = Phim::with('phim_theloai')->find($id);
            $request->session()->put('id', $id);
            $title = 'Chỉnh sửa Phim ' . $movieEdit->ten;
            $category = DanhMuc::all();
            $genre = TheLoai::all();
            $movie_genre = $movieEdit->phim_theloai;
            $country = QuocGia::all();
            return view('admin.phims.phim.edit', compact('title', 'movieEdit', 'category', 'genre', 'country', 'movie_genre'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('admin.movie.list');
        }
    }

    public function postedit(Request $request)
    {

        // $request->validate([
        //     'title' => 'required'
        // ],[
        //     'title.required' => 'Vui lòng nhập tên Danh Mục',
        // ]);

        $data = $request->all();
        // try {
            $id = session('id');
            $movie = Phim::find($id);
            $img = $request->image;
            $movie->ten = $request->input('title');
            $movie->slug = Str::slug($request->input('title'), '-');
            $movie->mota = $request->input('description');
            $movie->khoa = $request->input('status');
            $movie->phimhot = $request->input('movie_hot');
            $movie->chatluong = $request->input('resolution');
            $movie->phude = $request->input('subtitle');
            $movie->thoiluong = $request->input('time');
            $movie->tags = $request->input('tags');
            $movie->trailer = $request->input('trailer');
            if ($request->input('category_id') == 2) {
                $movie->sotap = 1;
            } else {
                $movie->sotap = $request->input('episodes');
            }
            $movie->danhmuc_id = $request->input('category_id');
            $movie->quocgia_id = $request->input('country_id');
            if ($img) {
                $Path = 'public/image/phim/' . $movie->hinhanh;
                if (file_exists($Path)) {
                    unlink($Path);
                }
                $ext = $request->image->extension();
                $file_name = time() . '-' . 'phim.' . $ext;
                $img->move(public_path('image/phim'), $file_name);

                $request->merge(['image/phim' => $file_name]);
                $movie->hinhanh = $file_name;
            }
            $movie->save();

            $movie->Phim_TheLoai()->sync($data['genre']);
            Session::flash('success', 'Cập nhật Phim thành công');
        // } catch (Exception $e) {
        //     Session::flash('error', 'Cập nhật lỗi. Vui lòng kiểm tra lại');
        // }
        return redirect()->route('admin.movie.list');
    }
    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Phim::find($data['id_movie']);
        $movie->nam = $data['year'];
        $movie->save();
    }
}
