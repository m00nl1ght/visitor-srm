<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\References\SystemAlarm;
use App\Models\Security\SecurityTeam;

class IncomeAlarm extends Model
{
  public $timestamps = false;

  use HasFactory;

  public function system_alarm_list()
  {
    return $this->belongsTo(SystemAlarm::class);
  }

  public function security_teams()
  {
    return $this->belongsToMany(SecurityTeam::class);
  }
}
