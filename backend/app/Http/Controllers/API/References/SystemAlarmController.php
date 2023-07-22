<?php

namespace App\Http\Controllers\API\References;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\References\SystemAlarmService;

class SystemAlarmController extends Controller
{
  private $systemAlarmService;

  public function __construct(
    SystemAlarmService $systemAlarmService,
  ) {
    $this->systemAlarmService = $systemAlarmService;
  }

  /**
   * @param 
   * @return 
   * Get system alarm list
   */
  public function index()
  {
    $list = $this->systemAlarmService->getList();
    return response()->success('Список категорий получен', $list);

    // $users = User::all();
    // return response()->success('Список пользователе получен', $users);
  }
}
