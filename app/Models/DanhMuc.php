<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table='danhmuc';

    public function Phim()
    {
        return $this->hasMany(Phim::class)->orderBy('id','DESC')->where('khoa', 1);
    }
}
