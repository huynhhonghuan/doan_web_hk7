<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table='danhmuc';

    protected $guarded = ['id'];

    protected $fillable =[
        'ten',
        'slug',
        'mota',
        'khoa'
    ];

    public function Phim()
    {
        return $this->hasMany(Phim::class, 'danhmuc_id')->orderBy('id','DESC')->where('khoa', 1);
    }


}
