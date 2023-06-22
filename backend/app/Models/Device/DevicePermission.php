<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\People\Employee;

class DevicePermission extends Model
{
  public $timestamps = false;

  use HasFactory;

  public function employee()
  {
    return $this->belongsTo(Employee::class);
  }
}
