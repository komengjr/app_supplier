<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogPenilaianCabDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_penilaian_cab_desc', function (Blueprint $table) {
            $table->id('id_log_penilaian_cab_desc');
            $table->string('log_penilaian_cab_code_desc')->unique();
            $table->string('log_master_code');
            $table->string('m_supplier_code');
            $table->string('m_barang_code');
            $table->string('master_cabang_code');
            $table->string('t_penilaian_detail_code');
            $table->text('log_penilaian_cab_desc_text')->nullable();
            $table->string('log_penilaian_cab_desc_status');
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
        Schema::dropIfExists('log_penilaian_cab_desc');
    }
}
