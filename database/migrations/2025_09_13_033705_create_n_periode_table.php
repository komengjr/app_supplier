<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_periode', function (Blueprint $table) {
            $table->id('id_n_periode');
            $table->string('n_periode_code')->unique();
            $table->string('n_periode_name');
            $table->string('n_periode_cabang');
            $table->date('n_periode_date');
            $table->string('n_periode_status');
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
        Schema::dropIfExists('n_periode');
    }
}
