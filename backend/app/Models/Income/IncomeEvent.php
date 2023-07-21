<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Security\SecurityTeam;

class IncomeEvent extends Model
{
  public $timestamps = false;
  use HasFactory;

  public function security_teams()
  {
    return $this->belongsToMany(SecurityTeam::class);
  }
}
