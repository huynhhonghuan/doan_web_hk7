<?php

namespace App\Http\Controllers\admin\phim;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\TapPhim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;

class TapPhimController extends Controller
{
    public function create(Request $request, $id)
    {
        try {
            $movie = Phim::find($id);
            $episode = TapPhim::where('phim_id', $id)->get();
            $request->session()->put('id', $id);
            $title = 'Thêm Tập Phim cho Phim ' . $movie->title;
            return view('admin.phims.tapphim.add', compact('title', 'movie', 'episode'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('admin.movie.list');
        }
    }

    public function postcreate(Request $request)
    {
        try {
            $id = session('id');
            $movie = Phim::with('danhmuc')->find($id);
            $episode = new TapPhim();
            $episode->phim_id = $id;
            $episode->linkphim = $request->input('linkphim');
            if($movie->DanhMuc->slug == 'phim-le')
            {
                $episode->tap = 1;
            }
            else
            {
                $episode->tap = $request->input('episode');
            }
            $episode->save();

            Session::flash('success', 'Thêm Tập Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Nhập lỗi. Vui lòng kiểm tra lại');
            $dieukien = 0;
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Tập Phim';
        $episode = TapPhim::pluck('phim_id')->toArray();
        $movie = Phim::with('tapphim')->withCount('tapphim')->whereIn('id', $episode)->get();

        return view('admin.phims.tapphim.list', compact('title', 'movie'));
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
            $episodeEdit = Phim::with('tapphim')->find($id);
            $request->session()->put('id', $id);
            $title = 'Chỉnh sửa Tập Phim cho Phim ' . $episodeEdit->ten;

            $episode = TapPhim::pluck('phim_id')->toArray();
            $movie = Phim::with('tapphim')->whereIn('id', $episode)->get();

            return view('admin.phims.tapphim.edit', compact('title', 'episodeEdit', 'movie'));
        } catch (Exception $e) {
            Session::flash('error', 'Phim không tồn tại');
            return redirect()->route('admin.episode.list');
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
        try {
        $id = session('id');
        $movie = Phim::with('tapphim')->find($id);
        $episode = TapPhim::where('phim_id', $id)->pluck('id')->toArray();

        $arr = [];
        $arr = array_unique($episode);
        $episodeEdit = TapPhim::whereIn('id', $arr)->get();
        foreach ($episodeEdit as $key => $ep) {
            $ep->linkphim = $request->input('linkphim'.$key.'');
            $ep->save();
        }

        Session::flash('success', 'Cập nhật Tập Phim thành công');
        } catch (Exception $e) {
            Session::flash('error', 'Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.episode.list');
    }
}
