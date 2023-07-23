<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeAlarmService;
use App\Services\Security\SecurityTeamService;

class IncomeAlarmController extends Controller
{
  private $incomeAlarmService;
  private $securityTeamService;

  public function __construct(
    IncomeAlarmService $incomeAlarmService,
    SecurityTeamService $securityTeamService,
  ) {
    $this->incomeAlarmService = $incomeAlarmService;
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
      $openAlarms = $this->incomeAlarmService->getOpenAlarms();
      return response($openAlarms);
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
      $securityTeam = $this->securityTeamService->getActive();
      $incomeAlarm = $this->incomeAlarmService->storeAlarm($request, $securityTeam->id);
      return response($incomeAlarm);
      // return response()->success('Событие добавлено успешно', $securityTeam->id);
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
    try {
      $incomeAlarm = $this->incomeAlarmService->showEvent($id);
      return response($incomeAlarm);
    } catch (\Exception $exception) {
      return response($exception);
    }
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
      $alarm = $this->incomeAlarmService->updateAlarm($id, $request);
      return response($alarm);
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
      $alarm = $this->incomeAlarmService->deleteAlarm($id);
      return response($alarm);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  public function closeAlarm(Request $request)
  {
    try {
      $alarm = $this->incomeAlarmService->closeAlarm($request);
      return response($alarm);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  public function getBySecurityTeam(Request $request)
  {
    try {
      $alarm = $this->incomeAlarmService->getBySecurityTeam($request->query('id'));
      return response($alarm);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
