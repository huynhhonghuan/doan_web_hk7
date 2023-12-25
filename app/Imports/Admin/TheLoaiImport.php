<?php

namespace App\Imports\Admin;

use App\Models\TheLoai;
use Maatwebsite\Excel\Concerns\ToModel;

class TheLoaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TheLoai([
            //
        ]);
    }
}
