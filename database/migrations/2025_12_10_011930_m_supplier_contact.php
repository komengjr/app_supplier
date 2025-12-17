<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MSupplierContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_contact', function (Blueprint $table) {
            $table->id('id_m_supplier_contact');
            $table->string('m_supplier_contact_code')->unique();
            $table->string('m_supplier_code');
            $table->string('m_supplier_contact_name');
            $table->string('m_supplier_contact_number');
            $table->string('m_supplier_contact_cabang')->nullable();
            $table->string('m_supplier_contact_status')->nullable();
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
        Schema::dropIfExists('m_supplier_contact');
    }
}
