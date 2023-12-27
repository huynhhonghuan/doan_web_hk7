<?php

namespace App\Imports\Admin;

use App\Models\User;
use App\Models\User_VaiTro;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TaiKhoanImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Sheet1' => new TaiKhoan(),
            'Sheet2' => new TaiKhoan_VaiTro(),
        ];
    }
}
class TaiKhoan implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([

            'name' => $row['name'],
            'username' => $row['username'],
            'sdt' => $row['sdt'],
            'email' => $row['email'],
            'password' => $row['password'],

        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
class TaiKhoan_VaiTro implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User_VaiTro([
            'user_id' => $row['user_id'],
            'vaitro_id' => $row['vaitro_id'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
