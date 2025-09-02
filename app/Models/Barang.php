<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'm_barang';
    protected $fillable = [
        'id_m_barang',
        'm_barang_code',
        'm_barang_name',
        'm_barang_cat',
        'm_barang_status',
        'created_at',
    ];
}
