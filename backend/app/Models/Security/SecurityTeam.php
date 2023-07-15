<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Security\Security;
use App\Models\Income\IncomeAlarm;

class SecurityTeam extends Model
{
  public $timestamps = false;
  use HasFactory;

  // Связь с начальником группы охраны
  public function chief()
  {
    return $this->belongsTo(Security::class, 'chief_id');
  }

  // Связь с оператором группы охраны
  public function operator()
  {
    return $this->belongsTo(Security::class, 'operator_id');
  }

  // Связь с сотрудниками смены
  public function securities()
  {
    return $this->belongsToMany(Security::class, 'security_team_members');
  }

  public function income_alarms()
  {
    return $this->belongsToMany(IncomeAlarm::class);
  }
}
