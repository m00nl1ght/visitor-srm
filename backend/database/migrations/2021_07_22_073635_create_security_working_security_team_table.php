<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecurityWorkingSecurityTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security_working_security_team', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('security_id');
            $table->unsignedBigInteger('working_security_team_id');

            $table->foreign('security_id')
                ->references('id')
                ->on('securities')
                ->onDelete('cascade');
            $table->foreign('working_security_team_id')
                ->references('id')
                ->on('working_security_teams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('security_working_security_team');
    }
}
