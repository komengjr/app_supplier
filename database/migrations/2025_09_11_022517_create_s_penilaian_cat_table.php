<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSPenilaianCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_penilaian_cat', function (Blueprint $table) {
            $table->id('id_s_penilaian_cat');
            $table->string('s_penilaian_cat_code')->unique();
            $table->string('s_penilaian_type_code');
            $table->string('s_penilaian_cat_name');
            $table->integer('s_penilaian_cat_score');
            $table->string('s_penilaian_cat_status');
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
        Schema::dropIfExists('s_penilaian_cat');
    }
}
