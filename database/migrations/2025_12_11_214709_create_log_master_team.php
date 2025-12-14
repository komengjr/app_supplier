<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogMasterTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_master_team', function (Blueprint $table) {
            $table->id('id_log_master_team');
            $table->string('log_master_team_code')->unique();
            $table->string('log_master_code');
            $table->string('log_master_team_jabatan');
            $table->string('log_master_team_nip');
            $table->string('log_master_team_name');
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
        Schema::dropIfExists('log_master_team');
    }
}
