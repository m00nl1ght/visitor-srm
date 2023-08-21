<?php

namespace App\Services\Card;

use App\Models\Card\Card;

class CardService
{
  public function getList()
  {
    try {
      $card = Card::with('cardCategory')->get();

      return $card;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function changeStatus($cardId, $status)
  {
    try {
      $card = Card::where('id', $cardId)->first();
      $card->issued = $status;
      $card->update();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function storeCard($data)
  {
    // $cardNumber, $cardCategoryId
    // ->number, $request->card_category_id
    $card = new Card();

    $card->number = $data->number;
    $card->issued = 0;
    $card->card_category_id = $data->card_category['id'];

    $card->save();
    return $card;
  }

  public function updateCard($data, $id)
  {
    try {
      $card = Card::where('id', $id)->first();

      if (!$card || $card->issued == 1) throw new \Exception('Cant edit this card');

      if (isset($data['number'])) $card->number = $data['number'];
      if (isset($data['card_category'])) $card->card_category_id = $data->card_category['id'];

      $card->update();
      return $card;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
