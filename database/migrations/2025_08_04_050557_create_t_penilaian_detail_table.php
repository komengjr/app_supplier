<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPenilaianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penilaian_detail', function (Blueprint $table) {
            $table->id('id_t_penilaian_detail');
            $table->string('t_penilaian_detail_code')->unique();
            $table->string('t_penilaian_cat_code');
            $table->string('t_penilaian_detail_name');
            $table->integer('t_penilaian_detail_point');
            $table->integer('t_penilaian_detail_type');
            $table->string('t_penilaian_detail_status');
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
        Schema::dropIfExists('t_penilaian_detail');
    }
}
