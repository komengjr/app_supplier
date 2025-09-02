<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPenilaianCatValTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penilaian_val', function (Blueprint $table) {
            $table->id('id_t_penilaian_val');
            $table->string('t_penilaian_val_code')->unique();
            $table->string('t_penilaian_cat_code');
            $table->string('t_penilaian_type_code');
            $table->string('t_penilaian_val_point');
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
        Schema::dropIfExists('t_penilaian_val');
    }
}
