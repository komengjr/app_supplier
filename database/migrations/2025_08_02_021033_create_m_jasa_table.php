<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMJasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_jasa', function (Blueprint $table) {
            $table->id('id_m_jasa');
            $table->string('m_jasa_code')->unique();
            $table->string('m_jasa_name');
            $table->string('m_jasa_cat');
            $table->string('m_jasa_status');
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
        Schema::dropIfExists('m_jasa');
    }
}
