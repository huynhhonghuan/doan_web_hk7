<?php

namespace App\Exports\Admin;

use App\Models\DanhMuc;
use Maatwebsite\Excel\Concerns\FromCollection;

class DanhMucExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DanhMuc::all();
    }
    public function headings(): array
    {
        return [
            'tendanhmuc',
            'slug',
            'mota',
            'khoa'
        ];
    }
    public function map($row): array
    {
        return [
            $row->ten,
            $row->slug,
            $row->mota,
            $row->khoa
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
