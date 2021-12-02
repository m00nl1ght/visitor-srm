<?php

namespace App\Models\Visitor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Income\Incomevisitor;
use App\Models\Firm\Firm;
use App\Models\Car\Car;
use App\Models\People\Position;

class Visitor extends Model
{
  public $timestamps = false;
  
  use HasFactory;

  public function firm()
  {
      return $this->belongsTo(Firm::class, 'firm_id');
  }

  public function car()
  {
      return $this->belongsTo(Car::class, 'car_id');
  }

  public function category() {
    return $this->belongsTo(VisitorCategory::class);
  }

  public function incomevisitor() {
    return $this->hasMany(Incomevisitor::class);
  }

  public function position() {
    return $this->belongsTo(Position::class);
  }
}
