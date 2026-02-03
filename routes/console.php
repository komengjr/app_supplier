<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('fix_supplier', function () {
    $data = DB::table('m_supplier')->get();
    foreach ($data as $value) {
        $alamat = DB::table('m_supplier_address')
            ->where('m_supplier_address_cabang', $value->m_supplier_cabang)
            ->where('m_supplier_code', $value->m_supplier_code)->first();
        if ($alamat) {
            $this->comment($value->m_supplier_name . ' - Sudah Ada');
        } else {
            DB::table('m_supplier_address')->insert([
                'm_supplier_address_code' => Str::uuid(),
                'm_supplier_code' => $value->m_supplier_code,
                'm_supplier_address_name' => $value->m_supplier_alamat,
                'm_supplier_address_cabang' => $value->m_supplier_cabang,
                'created_at' => now()
            ]);
            $this->comment($value->m_supplier_name . ' - Created');
        }
    }
});
Artisan::command('fix_document', function () {
    $data = DB::table('m_supplier_doc')->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'm_supplier_doc.m_supplier_code')->get();
    foreach ($data as $value) {
        if ($value->m_supplier_doc_cab == "") {
            DB::table('m_supplier_doc')->where('m_supplier_doc_code', $value->m_supplier_doc_code)->update([
                'm_supplier_doc_cab' => $value->m_supplier_cabang
            ]);
            $this->comment($value->m_supplier_doc_code . ' - Created');
        } else {
            $this->comment($value->m_supplier_doc_code . ' - Sudah Ada');
        }
    }
});
Artisan::command('fix_type', function () {
    $data = DB::table('m_supplier_type')->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'm_supplier_type.m_supplier_code')->get();
    foreach ($data as $value) {
        if ($value->m_supplier_type_cab == "") {
            DB::table('m_supplier_type')->where('m_supplier_type_code', $value->m_supplier_type_code)->update([
                'm_supplier_type_cab' => $value->m_supplier_cabang
            ]);
            $this->comment($value->m_supplier_type_code . ' - Created');
        } else {
            $this->comment($value->m_supplier_type_code . ' - Sudah Ada');
        }
    }
});
