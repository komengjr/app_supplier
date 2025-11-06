<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSPenilaianTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_penilaian_type', function (Blueprint $table) {
            $table->id('id_s_penilaian_type');
            $table->string('s_penilaian_type_code')->unique();
            $table->string('s_penilaian_type_name');
            $table->string('s_penilaian_type_status');
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
        Schema::dropIfExists('s_penilaian_type');
    }
}
