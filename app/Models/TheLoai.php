<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;

    protected $table = 'theloai';
    protected $fillable = [
        'tentheloai',
        'slug',
        'mota',
        'khoa',
    ];

    public function Phim()
    {
        return $this->belongsTo(Phim::class);
    }

    public function Truyen()
    {
        return $this->belongsTo(Truyen::class);
    }
}
