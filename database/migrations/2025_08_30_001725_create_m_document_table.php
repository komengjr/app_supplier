<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_document', function (Blueprint $table) {
            $table->id('id_m_document');
            $table->string('m_document_code')->unique();
            $table->string('m_document_type_code');
            $table->string('m_document_name');
            $table->text('m_document_desc');
            $table->string('m_document_status');
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
        Schema::dropIfExists('m_document');
    }
}
