<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'truyen_binhluan';

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
