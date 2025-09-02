<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_pengadaan', function (Blueprint $table) {
            $table->id('id_type_pengadaan_code');
            $table->string('type_pengadaan_code')->unique();
            $table->string('type_pengadaan_name');
            $table->string('type_pengadaan_status');
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
        Schema::dropIfExists('type_pengadaan');
    }
}
