<?php

namespace App\Http\Controllers\API\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Card\CardService;

class CardController extends Controller
{
  private $cardService;

  public function __construct
  (
    CardService $cardService
  )
  {
      $this->cardService = $cardService;
  }

  public function index() {
    try {
      $cards = $this->cardService->getList();
      return response()->success('Список карт получен', $cards);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
