<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSupplierDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_doc', function (Blueprint $table) {
            $table->id('id_m_supplier_doc');
            $table->string('m_supplier_doc_code')->unique();
            $table->string('m_supplier_code');
            $table->string('m_document_code');
            $table->string('m_supplier_doc_file');
            $table->date('m_supplier_doc_start');
            $table->date('m_supplier_doc_end');
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
        Schema::dropIfExists('m_supplier_doc');
    }
}
