<?php

namespace App\Imports;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Supplier([
            'm_supplier_code' => Str::uuid(),
            'm_supplier_name' => $row['nama_supplier'],
            'm_supplier_city' => $row['kota'],
            'm_supplier_alamat' => $row['alamat'],
            'm_supplier_phone' => $row['phone'],
            'm_supplier_email' => $row['email'],
            'm_supplier_cat' => $row['cat'],
            'm_supplier_cabang' => Auth::user()->access_cabang,
            'm_supplier_status' => 1,
            'created_at' => now(),
        ]);
    }
}
