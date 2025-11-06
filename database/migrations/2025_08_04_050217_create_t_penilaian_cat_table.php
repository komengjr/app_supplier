<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPenilaianCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penilaian_cat', function (Blueprint $table) {
            $table->id('id_t_penilaian_cat');
            $table->string('t_penilaian_cat_code')->unique();
            $table->string('t_penilaian_cat_name');
            $table->string('t_penilaian_cat_score');
            $table->string('t_penilaian_cat_status');
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
        Schema::dropIfExists('t_penilaian_cat');
    }
}
