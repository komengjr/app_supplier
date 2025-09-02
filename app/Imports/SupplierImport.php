<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Supplier([
            'm_supplier_code' => 'SUPP' . mt_rand(100000, 999999),
            'm_supplier_name' => $row['nama'],
            'm_supplier_city' => $row['city'],
            'm_supplier_alamat' => $row['alamat'],
            'm_supplier_phone' => $row['phone'],
            'm_supplier_status' => 1,
            'created_at' => now(),
        ]);
    }
}
