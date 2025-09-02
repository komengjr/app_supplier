<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_penilaian_cab', function (Blueprint $table) {
            $table->id('id_log_penilaian_cab');
            $table->string('log_penilaian_cab_code')->unique();
            $table->string('log_master_code');
            $table->string('m_supplier_code');
            $table->string('m_barang_code');
            $table->string('master_cabang_code');
            $table->string('t_penilaian_detail_code');
            $table->string('log_penilaian_cab_val');
            $table->string('log_penilaian_cab_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_penilaian_cab');
    }
}
