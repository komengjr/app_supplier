<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPenilaianPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penilaian_point', function (Blueprint $table) {
            $table->id('id_t_penilaian_point');
            $table->string('t_penilaian_point_code')->unique();
            $table->string('t_penilaian_detail_code');
            $table->string('t_penilaian_point_name');
            $table->string('t_penilaian_point_value');
            $table->string('t_penilaian_point_status');
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
        Schema::dropIfExists('t_penilaian_point');
    }
}
