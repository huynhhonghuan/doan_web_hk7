<?php

namespace App\Imports\Admin;

use App\Models\DanhMuc;
use Maatwebsite\Excel\Concerns\ToModel;

class DanhMucImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DanhMuc([
            'ten' => $row['ten'],
            'slug' => $row['slug'],
            'mota' => $row['mota'],
            'khoa' => $row['khoa']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
