<?php

namespace App\Http\Controllers\Admin\Truyen;

use App\Exports\Admin\TruyenExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TruyenRequest;
use App\Imports\Admin\TruyenImport;
use App\Models\QuocGia;
use App\Models\TacGia;
use App\Models\TheLoai;
use App\Models\Truyen;
use App\Models\Truyen_TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use ZipArchive;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách truyện';
        $danhsach = Truyen::orderby('id', 'ASC')->get();
        return view('admin.truyen.truyen.index', compact('title', 'danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới truyện';
        $quocgia = QuocGia::all();
        $tacgia = TacGia::all();
        $theloai = TheLoai::all();
        return view('admin.truyen.truyen.create', compact('title', 'quocgia', 'tacgia', 'theloai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TruyenRequest $request)
    {
        //dd($request->theloai_id);
        if ($request->validated()) {

            $slug = Str::slug($request->tentruyen, '-');

            $file_name = '';

            //dd($request->hasFile('hinhanh'));
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                //Tạo thư mục nếu chưa có
                // if (!File::isDirectory(public_path('image/truyen/' . $slug))) {
                //     File::makeDirectory(public_path('image/truyen/' . $slug), true);
                // }
                //Xử lý hình ảnh lưu theo thời gian thực để k trị trùng
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen-anhbia.' . $ext;
                //dd($file->move(public_path('image/truyen/' . $slug, $file_name)));
                $file->move('public/image/truyen/' . $slug, $file_name);
            }

            // dd($request->validated());
            $truyen = Truyen::create($request->validated() + [
                'slug' => $slug,
                'nhomdich' => $request->nhomdich ?? 'Không biết',
                'hinhanh' => $file_name,
                'user_id' => Auth::user()->id,
            ]);

            foreach ($request->theloai_id as $tl) {
                Truyen_TheLoai::create([
                    'truyen_id' => $truyen->id,
                    'theloai_id' => $tl
                ]);
            }
        }
        return redirect()->route('admin.truyen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Truyen $truyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truyen $truyen)
    {
        $title = 'Chỉnh sửa truyện';
        $quocgia = QuocGia::all();
        $tacgia = TacGia::all();

        //xử lý hiện ra thể loại có giá trị selected hay không
        $tl = TheLoai::all();
        $theloai = [];
        foreach ($tl as $value) {
            $selected = in_array(
                $value->id,
                $truyen->getTheLoai->pluck('id')->all(),
                true
            );
            $theloai[] = '<option value="' . $value->id . '"' . ($selected ? ' selected' : '') . '>' . $value->tentheloai . '</option>';
        }

        return view('admin.truyen.truyen.edit', compact('truyen', 'title', 'quocgia', 'tacgia', 'theloai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TruyenRequest $request, Truyen $truyen)
    {
        if ($request->validated()) {
            //băm tên truyện k dấu
            $slug = Str::slug($request->tentruyen, '-');

            //lấy tên hình ảnh cũ trước khi chỉnh
            $file_name = $truyen->hinhanh;

            //kiểm tra nếu thư mục bằng tên viết tắt có khác với trong database và thư mục đó đã tồn tại hay không
            //nếu đúng thì sửa đổi lại tên thư mục đó
            if ($truyen->slug != $slug && file_exists(public_path('image/truyen/' . $truyen->slug))) {
                rename(public_path('image/truyen/' . $truyen->slug), public_path('image/truyen/' . $slug));
            }
            if ($file = $request->file('hinhanh')) {
                //xóa ảnh cũ nằm trong thư mục
                if (File::exists(public_path('image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh)))
                    unlink(public_path('image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh));

                //thêm ảnh mới vào
                $ext = $request->file('hinhanh')->extension();
                $file_name = time() . '-' . 'truyen-anhbia.' . $ext; //cập nhật lại tên hình ảnh đã chỉnh
                $file->move('public/image/truyen/' . $slug, $file_name);
            }
            //dd($request->nhomdich);
            $truyen->update($request->validated() + [
                'slug' => $slug,
                'nhomdich' => $request->nhomdich ?? 'Không biết',
                'hinhanh' => $file_name,
            ]);

            $truyen_theloai = Truyen_TheLoai::where('truyen_id', $truyen->id)->get();
            //nếu có 1 thể loại nào đó trong truyen_theloai không tồn tại trong request thì thêm vào
            foreach ($truyen_theloai as $tl) {
                if (!in_array($tl->theloai_id, $request->theloai_id)) {
                    $tl->delete();
                }
            }

            $truyen_theloai_id = $truyen_theloai->pluck('theloai_id')->all();
            //nếu có 1 thể loại nào đó trong request không tồn tại trong truyen_theloai thì thêm vào
            foreach ($request->theloai_id as $tl) {
                if (!in_array($tl, $truyen_theloai_id)) {
                    Truyen_TheLoai::create([
                        'truyen_id' => $truyen->id,
                        'theloai_id' => $tl
                    ]);
                }
            }
        }
        return redirect()->route('admin.truyen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truyen $truyen)
    {
        //xóa thư mục hình ảnh
        // if (file_exists(public_path('image/truyen/' . $truyen->slug)))
        //     File::deleteDirectory(public_path('image/truyen/' . $truyen->slug));

        //xóa data trên db
        $truyen->update([
            'khoa' => 0
        ]);

        return redirect()->route('admin.truyen.index');
    }

    //duyệt
    public function khoa(Truyen $truyen)
    {
        $tr = Truyen::find($truyen->id);
        if ($truyen->khoa == 1) {
            $tr->khoa = 0;
            $tr->save();
        } else {
            $tr->khoa = 1;
            $tr->save();
        }
        return redirect()->route('admin.truyen.index');
    }

    public function postNhap(Request $request)
    {
        Excel::import(new TruyenImport(), $request->file('excel_file'));

        if ($file = $request->file('hinhanh')) {

            //$thumuc = [];
            foreach ($file as $hinhanh) {

                //lấy thông tin truyện từ hình tên hình ảnh
                //nếu tên hình ảnh trùng với tên hình ảnh được lưu trong db thì lấy thông tin truyện đó
                $truyen = Truyen::where('hinhanh', $hinhanh->getClientOriginalName())->first();

                //nếu thông tin chuyện khác null
                if ($truyen != null) {
                    //Tạo thư mục nếu chưa có
                    //dd(!File::isDirectory(public_path('image/truyen/' . $truyen->slug)));
                    if (!File::isDirectory(public_path('image/truyen/' . $truyen->slug))) {
                        File::makeDirectory(public_path('image/truyen/' . $truyen->slug), true);
                    }
                    //nếu hình ảnh chưa có thì thêm ảnh đó vào thư mục
                    if (!File::exists(public_path('image/truyen/' . $truyen->slug . '/' . $truyen->hinhanh))) {
                        $hinhanh->move('image/truyen/' . $truyen->slug, $hinhanh->getClientOriginalName());
                    }
                }
            }
        }

        return redirect()->route('admin.truyen.index');
    }

    public function getXuat()
    {
        return Excel::download(new TruyenExport(), 'truyen.xlsx');
    }

    //xuất tất cả hình ảnh ra file zip
    public function getHinh()
    {
        $zip = new ZipArchive();
        $file_name = 'truyen.zip';

        //xóa thư mục truyen.zip nếu đã có trước đó
        if (file_exists(public_path('image/truyen.zip')))
            File::deleteDirectory(public_path('image/truyen.zip'));

        $truyen = Truyen::all();
        if ($zip->open(public_path('image/' . $file_name), ZipArchive::CREATE) === True) {

            foreach ($truyen as $tr) {
                $files = File::files(public_path('image/truyen/' . $tr->slug));

                foreach ($files as $item) {
                    $zip->addFile($item, basename($item));
                }
            }

            $zip->close();
        }
        return response()->download(public_path('image/' . $file_name));
    }
}
