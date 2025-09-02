<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSupplierDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_data', function (Blueprint $table) {
            $table->id('id_m_supplier_data');
            $table->string('m_supplier_data_code');
            $table->string('m_supplier_code');
            $table->string('m_supplier_data_no');
            $table->string('m_supplier_data_npwp');
            $table->string('m_supplier_data_contact');
            $table->string('m_supplier_data_kacab');
            $table->string('m_supplier_data_mgr');
            $table->string('m_supplier_data_pgd');
            $table->string('m_supplier_data_cabang');
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
        Schema::dropIfExists('m_supplier_data');
    }
}
