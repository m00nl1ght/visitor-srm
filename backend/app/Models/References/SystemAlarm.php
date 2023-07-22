<?php

namespace App\Models\References;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAlarm extends Model
{
  public $timestamps = false;
  use HasFactory;

  protected $table = 'system_alarm_lists';
}
