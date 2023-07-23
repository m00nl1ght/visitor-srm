<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeFoggotenCardService;
use App\Services\People\EmployeeService;
use App\Services\People\PositionService;
use App\Services\Card\CardService;
use App\Services\Security\SecurityTeamService;

class IncomeFoggotenCardController extends Controller
{
  private $incomeFoggotenCardService;
  private $employeeService;
  private $positionService;
  private $cardService;
  private $securityTeamService;

  public function __construct(
    IncomeFoggotenCardService $incomeFoggotenCardService,
    EmployeeService $employeeService,
    PositionService $positionService,
    CardService $cardService,
    SecurityTeamService $securityTeamService,
  ) {
    $this->incomeFoggotenCardService = $incomeFoggotenCardService;
    $this->employeeService = $employeeService;
    $this->positionService = $positionService;
    $this->cardService = $cardService;
    $this->securityTeamService = $securityTeamService;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $list = $this->incomeFoggotenCardService->getIssuedCardList();
      return response($list);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
      //сотрудник
      $employee = $this->employeeService->getByFullName($request->employee);
      $position = $this->positionService->getOrCreate($request->employee['position']);

      if (!$employee) {
        $employee = $this->employeeService->createEmployee($request->employee, $position->id);
      } else {
        $employee = $this->employeeService->setPosition($employee->id, $position->id);
      }

      //руководитель сотрудника
      $boss = $this->employeeService->getByFullName($request->boss);
      $bossPosition = $this->positionService->getOrCreate($request->boss['position']);
      if (!$boss) {
        $boss = $this->employeeService->createEmployee($request->boss, $bossPosition->id);
      } else {
        $boss = $this->employeeService->setPosition($boss->id, $bossPosition->id);
      }

      //сменить статус карты
      $this->cardService->changeStatus($request->card_id, true);

      //выдать карту сотруднику
      $securityTeam = $this->securityTeamService->getActive();
      $data = [
        "securityTeamId" => $securityTeam->id,
        "employeeId" => $employee->id,
        "bossId" => $boss->id,
        "cardId" => $request->card_id,
      ];
      $resp = $this->incomeFoggotenCardService->setIssuedCard($data);

      return response($resp);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
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
      $incomeFoggotenCard = $this->incomeFoggotenCardService->returnIssuedCard($id, $request->out_time);
      $this->cardService->changeStatus($incomeFoggotenCard->card_id, false);
      return response(null);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $incomeFoggotenCard = $this->incomeFoggotenCardService->deleteIncomeCard($id);
      $this->cardService->changeStatus($incomeFoggotenCard->card_id, false);
      return response(null);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
