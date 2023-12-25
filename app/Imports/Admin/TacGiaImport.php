<?php

namespace App\Imports\Admin;

use App\Models\TacGia;
use Maatwebsite\Excel\Concerns\ToModel;

class TacGiaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TacGia([
            //
        ]);
    }
}
