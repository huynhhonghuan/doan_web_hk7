<?php

namespace App\Http\Controllers\admin\Thuvien;

use App\Exports\Admin\DanhMucExport;
use App\Http\Controllers\Controller;
use App\Imports\Admin\DanhMucImport;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class DanhMucController extends Controller
{
    public function create()
    {
        $title = 'Thêm danh mục mới';
        return view('admin.danhmuc.add',compact('title'));
    }

    public function postcreate(Request $request)
    {
        try{
            $category = new DanhMuc();
            $category->ten = $request->input('title');
            $category->slug = Str::slug($request->input('title'), '-');
            $category->mota = $request->input('description');
            $category->khoa = $request->input('status');

            $category->save();

            Session::flash('success','Tạo Danh Mục thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Nhập lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->back();
    }

    public function show()
    {
        $title = 'Danh sách Danh Mục';
        $categoryList = DanhMuc::orderby('id','ASC')->get();
        return view('admin.danhmuc.list',compact('title','categoryList'));
    }

    public function delete($id)
    {
        // try{
            $category = DanhMuc::find($id);
            $category->delete();

            Session::flash('success','Xóa Danh Mục thành công');
        // }catch(Exception $e)
        // {
        //     Session::flash('error','Xóa lỗi. Vui lòng kiểm tra lại');
        // }

        return redirect()->route('admin.danhmuc.list');
    }

    public function edit(Request $request, $id)
    {
        try{
            $categoryEdit = DanhMuc::find($id);
            $request->session()->put('id',$id);
            $title = 'Chỉnh sửa Danh Mục ' . $categoryEdit->ten;
            return view('admin.danhmuc.edit', compact('title','categoryEdit'));
        }catch(Exception $e)
        {
            Session::flash('error','Danh Mục không tồn tại');
            return redirect()->route('admin.danhmuc.list');
        }
    }

    public function postedit(Request $request)
    {

        // $request->validate([
        //     'title' => 'required'
        // ],[
        //     'title.required' => 'Vui lòng nhập tên Danh Mục',
        // ]);

        try{
            $id=session('id');
            $category = DanhMuc::find($id);
            $category->ten = $request->input('title');
            $category->slug = Str::slug($request->input('title'), '-');
            $category->mota = $request->input('description');
            $category->khoa = $request->input('status');
            $category->save();

            Session::flash('success','Cập nhật Danh Mục thành công');
        }catch(Exception $e)
        {
            Session::flash('error','Cập nhật lỗi. Vui lòng kiểm tra lại');
        }
        return redirect()->route('admin.danhmuc.list');
    }
    public function postNhap(Request $request)
    {
        Excel::import(new DanhMucImport, $request->file('file_excel'));
        return redirect()->route('admin.danhmuc.list');
    }

    public function getXuat()
    {
        return Excel::download(new DanhMucExport, 'danh-muc.xlsx');
    }

}
