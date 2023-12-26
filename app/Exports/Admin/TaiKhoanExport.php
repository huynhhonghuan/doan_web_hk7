<?php

namespace App\Exports\Admin;

use App\Models\User;
use App\Models\User_VaiTro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TaiKhoanExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Sheet1' => new TaiKhoan(),
            'Sheet2' => new TaiKhoan_VaiTro(),
        ];
    }
}

class TaiKhoan implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }
    public function headings(): array
    {
        return [
            'name',
            'username',
            'sdt',
            'email',
            'password',
        ];
    }
    public function map($row): array
    {
        return [
            $row->name,
            $row->username,
            $row->sdt,
            $row->email,
            $row->password
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}

class TaiKhoan_VaiTro implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    public function collection()
    {
        return User_VaiTro::all();
    }
    public function headings(): array
    {
        return [
            'user_id',
            'vaitro_id',
        ];
    }
    public function map($row): array
    {
        return [
            $row->user_id,
            $row->vaitro_id,
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
