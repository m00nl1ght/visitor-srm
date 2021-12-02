<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card\CardCategory;

class Card extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    public function cardCategory() {
      return $this->belongsTo(Cardcategory::class, 'card_category_id');
    }
}
