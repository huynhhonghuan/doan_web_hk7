<?php

namespace App\Exports\Admin;

use App\Models\QuocGia;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuocGiaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return QuocGia::all();
    }
}
