<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPenilaianJasaCab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_penilaian_jasa_cab', function (Blueprint $table) {
            $table->id('id_penilaian_jasa_cab');
            $table->string('penilaian_jasa_cab_code')->unique();
            $table->string('log_master_code');
            $table->string('m_supplier_code');
            $table->string('m_jasa_code');
            $table->string('master_cabang_code');
            $table->string('t_penilaian_detail_code');
            $table->string('penilaian_jasa_cab_val');
            $table->string('penilaian_jasa_cab_score');
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
        Schema::dropIfExists('log_penilaian_jasa_cab');
    }
}
