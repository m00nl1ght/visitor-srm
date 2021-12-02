<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeFoggotenCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_foggoten_cards', function (Blueprint $table) {
          $table->id();
          $table->dateTime('in_time', 0);
          $table->dateTime('out_time', 0)->nullable();
          $table->unsignedBigInteger('employee_id')->nullable();
          $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
          $table->unsignedBigInteger('boss_employee_id')->nullable();
          $table->foreign('boss_employee_id')->references('id')->on('employees')->onDelete('cascade');
          $table->unsignedBigInteger('card_id')->nullable();
          $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_foggoten_cards');
    }
}
