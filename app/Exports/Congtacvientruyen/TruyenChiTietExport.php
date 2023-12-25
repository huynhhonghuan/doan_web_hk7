<?php

namespace App\Exports\Congtacvientruyen;

use App\Models\TruyenChiTiet;
use Maatwebsite\Excel\Concerns\FromCollection;

class TruyenChiTietExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TruyenChiTiet::all();
    }
}
