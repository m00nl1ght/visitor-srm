<?php

namespace App\Http\Controllers\API\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Card\CardCategoryService;

class CardCategoryController extends Controller
{
  private $cardCategoryService;

  public function __construct(
    CardCategoryService $cardCategoryService
  ) {
    $this->cardCategoryService = $cardCategoryService;
  }

  public function index()
  {
    try {
      $categories = $this->cardCategoryService->getList();
      return response($categories);
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
  // public function store(Request $request)
  // {
  //   try {
  //     $card = $this->cardService->storeCard($request->number, $request->card_category_id);
  //     return response($card);
  //   } catch (\Exception $exception) {
  //     return response($exception);
  //   }
  // }
}
