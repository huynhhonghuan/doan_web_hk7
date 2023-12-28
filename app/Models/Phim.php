<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    use HasFactory;

    protected $table='phim';

    public function DanhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danhmuc_id', 'id');
    }

    // public function Genre()
    // {
    //     return $this->belongsTo(Genre::class, 'genre_id', 'id');
    // }

    public function QuocGia()
    {
        return $this->belongsTo(QuocGia::class, 'quocgia_id', 'id');
    }

    public function Phim_TheLoai()
    {
        return $this->belongsToMany(TheLoai::class, 'phim_theloai', 'phim_id','theloai_id');
    }

    public function TapPhim()
    {
        return $this->hasMany(TapPhim::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
