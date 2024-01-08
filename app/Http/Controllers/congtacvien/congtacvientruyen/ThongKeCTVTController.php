<?php

namespace App\Http\Controllers\congtacvien;

use App\Http\Controllers\Controller;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\BackupManager;

use Illuminate\Support\Facades\Backup;

class ThongKeCTVTController extends Controller
{
    public function home()
    {
        $title = 'Thống kê';
        
       
        
        return view('congtacvientruyen.home', compact('title', 'truyendadang', 'truyenchoduyet', 'truyenduocduyet',));
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
