<?php

namespace App\Exports\Admin;

use App\Models\Truyen as ModelsTruyen;
use App\Models\Truyen_TheLoai as ModelsTruyen_TheLoai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TruyenExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Sheet1' => new Truyen(),
            'Sheet2' => new Truyen_TheLoai(),
        ];
    }
}

class Truyen implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ModelsTruyen::all();
    }
    public function headings(): array
    {
        return [
            'tentruyen',
            'slug',
            'mota',
            'khoa',
            'nhomdich',
            'hinhanh',
            'tacgia_id',
            'quocgia_id',
            'user_id'
        ];
    }
    public function map($row): array
    {
        return [
            $row->tentruyen,
            $row->slug,
            $row->mota,
            $row->khoa,
            $row->nhomdich,
            $row->hinhanh,
            $row->tacgia_id,
            $row->quocgia_id,
            $row->user_id
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
class Truyen_TheLoai implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    public function collection()
    {
        return ModelsTruyen_TheLoai::all();
    }
    public function headings(): array
    {
        return [
            'truyen_id',
            'theloai_id',
        ];
    }
    public function map($row): array
    {
        return [
            $row->truyen_id,
            $row->theloai_id
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
