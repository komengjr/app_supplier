<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSuppRujukanCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_supp_rujukan_cab', function (Blueprint $table) {
            $table->id('id_data_supp_rujukan_cab');
            $table->string('data_supp_rujukan_cab_code')->unique();
            $table->string('log_master_code');
            $table->string('m_pemeriksaan_code');
            $table->string('m_rujukan_code');
            $table->string('master_cabang_code');
            $table->string('data_supp_rujukan_cab_score');
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
        Schema::dropIfExists('data_supp_rujukan_cab');
    }
}
