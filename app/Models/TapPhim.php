<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapPhim extends Model
{
    use HasFactory;
    protected $table='tapphim';

    public function Phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }
}
