<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MSupplierEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_email', function (Blueprint $table) {
            $table->id('id_m_supplier_email');
            $table->string('m_supplier_email_code')->unique();
            $table->string('m_supplier_code');
            $table->string('m_supplier_email_name');
            $table->string('m_supplier_email_link');
            $table->string('m_supplier_email_cabang');
            $table->string('m_supplier_email_status')->nullable();
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
        Schema::dropIfExists('m_supplier_email');
    }
}
