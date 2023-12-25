<?php

namespace App\Imports\Congtacvientruyen;

use App\Models\Truyen;
use Maatwebsite\Excel\Concerns\ToModel;

class TruyenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Truyen([
            //
        ]);
    }
}
