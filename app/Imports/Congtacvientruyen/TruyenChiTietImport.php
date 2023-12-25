<?php

namespace App\Imports\Congtacvientruyen;

use App\Models\TruyenChiTiet;
use Maatwebsite\Excel\Concerns\ToModel;

class TruyenChiTietImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TruyenChiTiet([
            //
        ]);
    }
}
