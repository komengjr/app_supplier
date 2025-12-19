<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MSupplierTrash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier_trash', function (Blueprint $table) {
            $table->id('id_m_supplier_trash');
            $table->string('m_supplier_trash_code')->unique();
            $table->string('m_supplier_code');
            $table->string('m_supplier_trash_name');
            $table->string('m_supplier_trash_city');
            $table->text('m_supplier_trash_alamat');
            $table->string('m_supplier_trash_phone')->nullable();
            $table->string('m_supplier_trash_email')->nullable();
            $table->string('m_supplier_trash_cabang');
            $table->string('m_supplier_trash_status');
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
        Schema::dropIfExists('m_supplier_trash');
    }
}
