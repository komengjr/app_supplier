<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenawaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_penawaran', function (Blueprint $table) {
            $table->id('id_data_penawaran');
            $table->string('data_penawaran_code')->unique();
            $table->string('data_penawaran_name');
            $table->string('data_penawaran_cabang');
            $table->text('data_penawaran_tujuan');
            $table->bigInteger('data_penawaran_anggaran');
            $table->string('data_penawaran_status');
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
        Schema::dropIfExists('data_penawaran');
    }
}
