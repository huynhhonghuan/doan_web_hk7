<?php

namespace App\Http\Controllers\Admin\Thuvien;

use App\Exports\Admin\QuocGiaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuocGiaRequest;
use App\Imports\Admin\QuocGiaImport;
use App\Models\QuocGia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class QuocGiaController extends Controller
{
    public function index()
    {
        $title = 'Danh sách quốc gia';
        $danhsach = QuocGia::orderby('id', 'ASC')->get();
        return view('admin.thuvien.quocgia.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới quốc gia';
        return view('admin.thuvien.quocgia.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuocGiaRequest $request)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->tenquocgia, '-');
            QuocGia::create($request->validated() + ['slug' => $slug]);
        }
        return redirect()->route('admin.quocgia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuocGia $quocGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuocGia $quocgium)
    {
        //dd($quocgium);
        $title = 'Chỉnh sửa quốc gia';
        $quocgia = $quocgium;
        return view('admin.thuvien.quocgia.edit', compact('quocgia', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuocGiaRequest $request, QuocGia $quocgium)
    {
        if ($request->validated()) {
            $slug = Str::slug($request->tenquocgia, '-');
            $quocgium->update($request->validated() + ['slug' => $slug]);
        }

        return redirect()->route('admin.quocgia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuocGia $quocgium)
    {
        $quocgium->delete();
        return redirect()->route('admin.quocgia.index');
    }
    public function khoa(QuocGia $quocgia)
    {
        $tr = QuocGia::find($quocgia->id);
        if ($quocgia->khoa == 1) {
            $tr->khoa = 0;
            $tr->save();
        } else {
            $tr->khoa = 1;
            $tr->save();
        }
        return redirect()->route('admin.quocgia.index');
    }

    public function postNhap(Request $request)
    {
        Excel::import(new QuocGiaImport, $request->file('file_excel'));
        return redirect()->route('admin.quocgia.index');
    }

    public function getXuat()
    {
        return Excel::download(new QuocGiaExport(), 'quoc-gia.xlsx');
    }
}
