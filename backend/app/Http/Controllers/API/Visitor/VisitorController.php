<?php

namespace App\Http\Controllers\API\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Visitor\VisitorService;

class VisitorController extends Controller
{
  private $visitorService;

  public function __construct(VisitorService $visitorService)
  {
      $this->visitorService = $visitorService;
  }

    /**
     * Search by part of surname
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchBySurname(Request $request)
    {
      try {
        $visitorList = $this->visitorService->searchBySurname($request->last_name);
        return response()->success('Список для поиска получен', $visitorList);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
        
    }
}
