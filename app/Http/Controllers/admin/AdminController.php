<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\Truyen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\BackupManager;

use Illuminate\Support\Facades\Backup;

class AdminController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        $phimdang = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa', 1)->orderBy('id', 'DESC')->count();
        $phimcho = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->withCount('tapphim')->where('khoa', 0)->orderBy('id', 'DESC')->count();

        $truyendang = Truyen::all()->count();
        $truyenduyet = Truyen::where('khoa', 1)->count();
        $truyenchuaduyet = Truyen::where('khoa', 0)->count();

        //Lấy số lượng của từng loại tài khoản
        $tk_admin = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'admin');
            })
            ->count();
        $tk_ctvt = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'ctvt');
            })
            ->count();
        $tk_ctvp = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'ctvp');
            })
            ->count();
        $tk_nd = User::with('getVaiTro')
            ->whereHas('getVaiTro', function ($query) {
                $query->where('vaitro.id', 'nd');
            })
            ->count();
        return view('admin.home', compact('title', 'phimdang', 'phimcho', 'truyendang', 'truyenduyet', 'truyenchuaduyet', 'tk_admin', 'tk_ctvt', 'tk_ctvp', 'tk_nd'));
    }

    // public function saoluu()
    // {
    //     $filename = 'phim-truyen-' . date('Y-m-d-H-i-s') . '.sql';

    //     $backup = Backup::backup();

    //     Storage::disk('public')->put($filename, $backup);

    //     return response()->download($filename);
    // }
    public function saoluu()
    {
        $filename = 'phim-truyen-' . date('Y-m-d-H-i-s') . '.sql';

        $backupManager = new BackupManager();

        $backup = $backupManager->backup();

        Storage::disk('public')->put($filename, $backup);

        return response()->download($filename);
    }
    public function phuchoi(Request $request)
    {
        DB::restore(public_path('backups/database.zip'));
    }
}
