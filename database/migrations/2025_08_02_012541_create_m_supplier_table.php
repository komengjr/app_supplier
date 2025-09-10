<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->id('id_m_supplier');
            $table->string('m_supplier_code')->unique();
            $table->string('m_supplier_name');
            $table->string('m_supplier_city');
            $table->text('m_supplier_alamat');
            $table->string('m_supplier_phone')->nullable();
            $table->string('m_supplier_email')->nullable();
            $table->string('m_supplier_cabang');
            $table->string('m_supplier_status');
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
        Schema::dropIfExists('m_supplier');
    }
}
