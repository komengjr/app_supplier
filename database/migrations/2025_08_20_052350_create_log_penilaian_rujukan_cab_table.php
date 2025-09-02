<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPenilaianRujukanCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_penilaian_rujukan_cab', function (Blueprint $table) {
            $table->id('id_penilaian_rujukan_cab');
            $table->string('penilaian_rujukan_cab_code')->unique();
            $table->string('log_master_code');
            $table->string('m_rujukan_code');
            $table->string('m_pemeriksaan_code');
            $table->string('master_cabang_code');
            $table->string('t_penilaian_detail_code');
            $table->string('penilaian_rujukan_cab_val');
            $table->string('penilaian_rujukan_cab_score');
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
        Schema::dropIfExists('log_penilaian_rujukan_cab');
    }
}
