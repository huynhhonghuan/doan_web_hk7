<?php

namespace App\Exports\Admin;

use App\Models\TheLoai;
use Maatwebsite\Excel\Concerns\FromCollection;

class TheLoaiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TheLoai::all();
    }
}
