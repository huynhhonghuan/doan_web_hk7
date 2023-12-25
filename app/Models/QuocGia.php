<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model
{
    use HasFactory;
    protected $table='quocgia';

    protected $guarded = ['id'];

    protected $fillable =[
        'ten',
        'slug',
        'mota',
        'khoa'
    ];

    public function Truyen()
    {
        return $this->hasMany(Truyen::class,'quocgia_id','id');
    }

    public function Phim()
    {
        return $this->hasMany(Phim::class,'quocgia_id','id');
    }
}
