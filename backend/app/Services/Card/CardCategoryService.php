<?php

namespace App\Services\Card;

use App\Models\Card\CardCategory;

class CardCategoryService
{
  public function getList()
  {
    try {
      $categories = CardCategory::get();

      return $categories;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // public function changeStatus($cardId, $status)
  // {
  //   try {
  //     $card = Card::where('id', $cardId)->first();
  //     $card->issued = $status;
  //     $card->update();
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }

  // public function storeCard($cardNumber, $cardCategoryId)
  // {
  //   $card = new Card();

  //   $card->number = $cardNumber;
  //   $card->issued = 0;
  //   $card->card_category_id = $cardCategoryId;

  //   $card->save();
  //   return $card;
  // }
}
