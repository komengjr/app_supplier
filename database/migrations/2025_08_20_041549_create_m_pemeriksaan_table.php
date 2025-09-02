<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pemeriksaan', function (Blueprint $table) {
            $table->id('id_m_pemeriksaan');
            $table->string('m_pemeriksaan_code')->unique();
            $table->string('m_pemeriksaan_name');
            $table->string('m_pemeriksaan_status');
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
        Schema::dropIfExists('m_pemeriksaan');
    }
}
