<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\People\Position;

class Employee extends Model
{
  public $timestamps = false;
  
  use HasFactory;

  public function position() {
    return $this->belongsTo(Position::class);
  }
}