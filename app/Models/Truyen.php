<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $table = 'truyen';

    protected $fillable = [
        'tentruyen',
        'slug',
        'mota',
        'khoa',
        'nhomdich',
        'hinhanh',
        'luotxem',
        'tacgia_id',
        'quocgia_id',
        'user_id'
    ];

    protected $attributes = [
        'nhomdich' => 'Không biết',
    ];

    public function QuocGia()
    {
        return $this->belongsTo(QuocGia::class, 'quocgia_id', 'id');
    }
    public function TacGia()
    {
        return $this->belongsTo(TacGia::class, 'tacgia_id', 'id');
    }
    public function TheLoai()
    {
        return $this->belongsTo(TheLoai::class, 'theloai_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function TruyenChiTiet()
    {
        return $this->hasMany(TruyenChiTiet::class, 'truyen_id', 'id');
    }
    //truyen - truyện_thelaai - theloai
    //tử bảng truyện lấy tên thể loại qua bảng trung gian truyen_theloai
    public function getTheLoai()
    {
        return $this->belongsToMany('App\Model\TheLoai', 'truyen_theloai', 'truyen_id', 'theloai_id');
    }
}
