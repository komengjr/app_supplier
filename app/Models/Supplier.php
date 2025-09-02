<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'm_supplier';
    protected $fillable = [
        'id_m_supplier',
        'm_supplier_code',
        'm_supplier_name',
        'm_supplier_city',
        'm_supplier_alamat',
        'm_supplier_phone',
        'm_supplier_status',
        'created_at',
    ];
}
