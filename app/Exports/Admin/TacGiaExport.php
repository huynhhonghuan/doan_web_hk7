<?php

namespace App\Exports\Admin;

use App\Models\TacGia;
use Maatwebsite\Excel\Concerns\FromCollection;

class TacGiaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TacGia::all();
    }
}
