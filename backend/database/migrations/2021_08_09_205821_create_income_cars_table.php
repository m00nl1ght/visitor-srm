<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_cars', function (Blueprint $table) {
            $table->id();
            $table->dateTime('in_time', 0);
            $table->dateTime('out_time', 0)->nullable();
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');

            $table->unsignedBigInteger('security_id')->nullable();
            $table->foreign('security_id')->references('id')->on('securities')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            
            $table->unsignedBigInteger('visitor_category_id')->nullable();
            $table->foreign('visitor_category_id')->references('id')->on('visitor_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_cars');
    }
}
