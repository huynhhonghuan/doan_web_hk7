<?php

namespace App\Exports\Admin;

use App\Models\DanhMuc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DanhMucExport implements FromCollection,  WithHeadings, WithCustomStartCell, WithMapping
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
            'ten',
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
