<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRujukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rujukan', function (Blueprint $table) {
            $table->id('id_m_rujukan');
            $table->string('m_rujukan_code')->unique();
            $table->string('m_rujukan_name');
            $table->string('m_rujukan_status');
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
        Schema::dropIfExists('m_rujukan');
    }
}
