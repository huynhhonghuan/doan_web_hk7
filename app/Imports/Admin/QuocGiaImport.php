<?php

namespace App\Imports\Admin;

use App\Models\QuocGia;
use Maatwebsite\Excel\Concerns\ToModel;

class QuocGiaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QuocGia([
            //
        ]);
    }
}
