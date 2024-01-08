<?php

namespace App\Imports\Congtacvientruyen;

use App\Models\Truyen as ModelsTruyen;
use App\Models\Truyen_TheLoai as ModelsTruyen_TheLoai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TruyenImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Sheet1' => new Truyen(),
            'Sheet2' => new Truyen_TheLoai()
        ];
    }
}

class Truyen implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ModelsTruyen([
            'tentruyen' => $row['tentruyen'],
            'slug' => $row['slug'],
            'mota' => $row['mota'],
            'khoa' => 0,
            'nhomdich' => $row['nhomdich'],
            'hinhanh' => $row['hinhanh'],
            'tacgia_id' => $row['tacgia_id'],
            'quocgia_id' => $row['quocgia_id'],
            'user_id' => $row['user_id'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}

class Truyen_TheLoai implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ModelsTruyen_TheLoai([
            'truyen_id' => $row['truyen_id'],
            'theloai_id' => $row['theloai_id'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
