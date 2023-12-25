<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen_TheLoai extends Model
{
    use HasFactory;

    protected $table = 'truyen_theloai';
    protected $fillable = [
        'truyen_id',
        'theloai_id',
    ];
}
