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

    Schema::create('income_visitor_security_team', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('income_visitor_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('income_visitor_id')
        ->references('id')
        ->on('income_visitors')
        ->onDelete('cascade');

      $table->foreign('security_team_id')
        ->references('id')
        ->on('security_teams')
        ->onDelete('cascade');
    });

    Schema::create('income_car_security_team', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('income_car_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('income_car_id')
        ->references('id')
        ->on('income_cars')
        ->onDelete('cascade');

      $table->foreign('security_team_id')
        ->references('id')
        ->on('security_teams')
        ->onDelete('cascade');
    });

    Schema::create('income_event_security_team', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('income_event_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('income_event_id')
        ->references('id')
        ->on('income_events')
        ->onDelete('cascade');

      $table->foreign('security_team_id')
        ->references('id')
        ->on('security_teams')
        ->onDelete('cascade');
    });

    Schema::create('income_card_security_team', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('income_foggoten_card_id');
      $table->unsignedBigInteger('security_team_id');

      $table->foreign('income_foggoten_card_id')
        ->references('id')
        ->on('income_foggoten_cards')
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
    Schema::dropIfExists('income_visitor_security_team');
    Schema::dropIfExists('income_car_security_team');
    Schema::dropIfExists('income_event_security_team');
    Schema::dropIfExists('income_card_security_team');
  }
}
