<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSPenilaianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_penilaian_detail', function (Blueprint $table) {
            $table->id('id_s_penilaian_detail');
            $table->string('s_penilaian_detail_code')->unique();
            $table->string('s_penilaian_cat_code');
            $table->string('s_penilaian_detail_name');
            $table->integer('s_penilaian_detail_point');
            $table->string('s_penilaian_detail_type');
            $table->string('s_penilaian_detail_status');
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
        Schema::dropIfExists('s_penilaian_detail');
    }
}
