<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_master', function (Blueprint $table) {
            $table->id('id__log_master');
            $table->string('log_master_code')->unique();
            $table->string('log_master_periode');
            $table->string('log_master_cabang');
            $table->string('log_master_status');
            $table->string('log_master_date');
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
        Schema::dropIfExists('log_master');
    }
}
