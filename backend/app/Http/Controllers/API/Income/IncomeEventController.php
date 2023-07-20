<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeEventService;
use App\Services\Security\SecurityTeamService;

class IncomeEventController extends Controller
{
  private $incomeEventService;
  private $securityTeamService;

  public function __construct(
    IncomeEventService $incomeEventService,
    SecurityTeamService $securityTeamService,
  ) {
    $this->incomeEventService = $incomeEventService;
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
      $incomeEvent = $this->incomeEventService->getEvent();
      return response()->success('Список успешно получен', $incomeEvent);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
      $incomeEvent = $this->incomeEventService->storeEvent($request, $securityTeam->id);
      return response()->success('Событие добавлено успешно', $incomeEvent);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
      $incomeEvent = $this->incomeEventService->showEvent($id);
      return response()->success('Событие получено успешно', $incomeEvent);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
      $incomeEvent = $this->incomeEventService->updateEvent($id, $request);
      return response()->success('Событие успешно обновлено', $incomeEvent);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
      $event = $this->incomeEventService->deleteEvent($id);
      return response()->success('Событие обновлено удалено', $event);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }
}
