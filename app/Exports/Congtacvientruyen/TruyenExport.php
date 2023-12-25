<?php

namespace App\Exports\Congtacvientruyen;

use App\Models\Truyen;
use Maatwebsite\Excel\Concerns\FromCollection;

class TruyenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Truyen::all();
    }
}
