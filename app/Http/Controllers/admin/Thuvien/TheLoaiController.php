<?php

namespace App\Http\Controllers\Admin\Thuvien;

use App\Exports\Admin\TheLoaiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TheLoaiRequest;
use App\Imports\Admin\TheLoaiImport;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TheLoaiController extends Controller
{
    public function index()
    {
        $title = 'Danh sách thể toại';
        $danhsach = TheLoai::orderby('id', 'ASC')->get();
        return view('admin.thuvien.theloai.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới Thể Loại';
        return view('admin.thuvien.TheLoai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TheLoaiRequest $request)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->tentheloai, '-');
            TheLoai::create($request->validated() + ['slug' => $slug]);
        }
        return redirect()->route('admin.theloai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TheLoai $theloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TheLoai $theloai)
    {
        //dd($tacgium);
        $title = 'Chỉnh sửa Thể Loại';
        return view('admin.thuvien.theloai.edit', compact('theloai', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TheLoaiRequest $request, TheLoai $theloai)
    {
        // $request->validate([
        //     'tentheloai' => 'required|string',
        // ]);
        //dd($tacgium);
        if ($request->validated()) {
            $slug = Str::slug($request->tentheloai, '-');
            $theloai->update($request->validated() + ['slug' => $slug]);
        }

        return redirect()->route('admin.theloai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TheLoai $theloai)
    {
        $theloai->delete();
        return redirect()->route('admin.theloai.index');
    }
    public function khoa(TheLoai $theloai)
    {
        $tr = TheLoai::find($theloai->id);
        if ($theloai->khoa == 1) {
            $tr->khoa = 0;
            $tr->save();
        } else {
            $tr->khoa = 1;
            $tr->save();
        }
        return redirect()->route('admin.theloai.index');
    }

    public function postNhap(Request $request)
    {
        Excel::import(new TheLoaiImport, $request->file('file_excel'));
        return redirect()->route('admin.theloai.index');
    }

    public function getXuat()
    {
        return Excel::download(new TheLoaiExport, 'the-loai.xlsx');
    }
}
