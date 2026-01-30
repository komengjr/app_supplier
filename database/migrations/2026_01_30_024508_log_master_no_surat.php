<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogMasterNoSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_master_no_surat', function (Blueprint $table) {
            $table->id('id_log_master_no_surat');
            $table->string('log_master_no_surat_code')->unique();
            $table->string('log_master_code');
            $table->string('log_master_no_surat_keputusan');
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
        Schema::dropIfExists('log_master_no_surat');
    }
}
