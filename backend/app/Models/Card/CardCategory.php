<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car\Card;

class CardCategory extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function card() {
      return $this->hasMany(Card::class);
  }
}
