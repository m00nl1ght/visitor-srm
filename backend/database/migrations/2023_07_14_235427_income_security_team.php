<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncomeSecurityTeam extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('income_alarm_security_team', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('income_alarm_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('income_alarm_id')
        ->references('id')
        ->on('income_alarms')
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
    Schema::dropIfExists('income_alarm_security_team');
  }
}
