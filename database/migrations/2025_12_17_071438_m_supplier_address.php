<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MSupplierAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_address', function (Blueprint $table) {
            $table->id('id_m_supplier_address');
            $table->string('m_supplier_address_code')->unique();
            $table->string('m_supplier_code');
            $table->text('m_supplier_address_name');
            $table->string('m_supplier_address_cabang');
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
        Schema::dropIfExists('m_supplier_address');
    }
}
