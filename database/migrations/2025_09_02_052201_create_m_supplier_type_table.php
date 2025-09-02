<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSupplierTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_type', function (Blueprint $table) {
            $table->id('id_m_supplier_type');
            $table->string('m_supplier_type_code')->unique();
            $table->string('m_supplier_code');
            $table->string('type_pengadaan_code');
            $table->string('m_supplier_type_status');
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
        Schema::dropIfExists('m_supplier_type');
    }
}
