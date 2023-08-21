<?php

namespace App\Http\Controllers\API\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Card\CardService;

class CardController extends Controller
{
  private $cardService;

  public function __construct(
    CardService $cardService
  ) {
    $this->cardService = $cardService;
  }

  public function index()
  {
    try {
      $cards = $this->cardService->getList();
      return response($cards);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $card = $this->cardService->storeCard($request);
      return response($card);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
      $card = $this->cardService->updateCard($request, $id);
      return response($card);
    } catch (\Exception $exception) {
      return response($exception->getMessage());
    }
  }
}
