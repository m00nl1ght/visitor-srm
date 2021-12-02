<?php

namespace App\Services\Card;

use App\Models\Card\Card;

class CardService
{
  public function getList() {
    try {
      $card = Card::with('cardCategory')->get();

      return $card;
    } catch (\Exception $exception){
        throw new \Exception($exception->getMessage());
    }
  }
  
  public function changeStatus($cardId, $status) {
    try {
      $card = Card::where('id', $cardId)->first();
      $card->issued = $status;
      $card->update();
    } catch (\Exception $exception){
        throw new \Exception($exception->getMessage());
    }
  }
}