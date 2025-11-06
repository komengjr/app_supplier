<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSPenilaianPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_penilaian_point', function (Blueprint $table) {
            $table->id('id_s_penilaian_point');
            $table->string('s_penilaian_point_code')->unique();
            $table->string('s_penilaian_detail_code');
            $table->string('s_penilaian_point_name');
            $table->string('s_penilaian_point_value');
            $table->string('s_penilaian_point_status');
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
        Schema::dropIfExists('s_penilaian_point');
    }
}
