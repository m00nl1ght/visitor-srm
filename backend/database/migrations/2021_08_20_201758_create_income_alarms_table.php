<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_alarms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('place')->nullable();
            $table->string('comment')->nullable();
            $table->dateTime('in_time', 0);
            $table->dateTime('out_time', 0)->nullable();
            $table->unsignedBigInteger('system_alarm_list_id')->nullable();
            $table->foreign('system_alarm_list_id')->references('id')->on('system_alarm_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_alarms');
    }
}
