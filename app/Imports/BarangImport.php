<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        return new Barang([
            'm_barang_code' => 'BRG' . mt_rand(100000, 999999),
            'm_barang_name' => $row['nama'],
            'm_barang_cat' => $row['cat'],
            'm_barang_status' => $row['status'],
            'created_at' => now(),
        ]);
    }
}
