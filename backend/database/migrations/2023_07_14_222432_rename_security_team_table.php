<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSecurityTeamTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('working_security_teams');
    Schema::dropIfExists('security_working_security_team');

    Schema::create('security_teams', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('chief_id')->nullable();
      $table->foreign('chief_id')
        ->references('id')
        ->on('securities');

      $table->unsignedBigInteger('operator_id')->nullable();
      $table->foreign('operator_id')
        ->references('id')
        ->on('securities');
    });

    Schema::create('security_team_members', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('security_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('security_id')
        ->references('id')
        ->on('securities')
        ->onDelete('cascade');
      $table->foreign('security_team_id')
        ->references('id')
        ->on('security_teams')
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
    Schema::dropIfExists('security_teams');
    Schema::dropIfExists('security_team_members');
  }
}
