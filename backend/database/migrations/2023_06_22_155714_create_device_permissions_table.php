<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePermissionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('device_permissions', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('device');
      $table->unsignedBigInteger('employee_id')->nullable();
      $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
      $table->enum('status', ['new', 'approved', 'rejected', 'closed',]);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('device_permissions');
  }
}
