<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Services\Income\IncomeVisitorService;
use App\Services\Income\IncomeCarService;
use App\Services\Income\IncomeAlarmService;
use App\Services\Income\IncomeEventService;
use App\Services\Income\IncomeFoggotenCardService;

use App\Services\WorkingSecurityTeam\WorkingSecurityTeamService;

class ReportController extends Controller
{
  private $workingSecurityTeamService;

  public function __construct
  (
    WorkingSecurityTeamService $workingSecurityTeamService,
    IncomeVisitorService $incomeVisitorService,
    IncomeCarService $incomeCarService,
    IncomeAlarmService $incomeAlarmService,
    IncomeEventService $incomeEventService,
    IncomeFoggotenCardService $incomeFoggotenCardService
  )
  {
      $this->workingSecurityTeamService = $workingSecurityTeamService;
      $this->incomeVisitorService = $incomeVisitorService;
      $this->incomeCarService = $incomeCarService;
      $this->incomeAlarmService = $incomeAlarmService;
      $this->incomeEventService = $incomeEventService;
      $this->incomeFoggotenCardService = $incomeFoggotenCardService;
  }

  public function byDay(Request $request)
  {
      try {
          $startDay = new Carbon($request->get('date'));
          $endDay = new Carbon($request->date);
          $endDay->addDays(1);

          $reportData = $this->getReportData($startDay, $endDay);

          return response()->success('Отчет успешно получен', $reportData);
      } catch (\Exception $exception) {
          return response()->error('Ошибка получения отчета', $exception->getMessage());
      }
  }

  public function bySecurityTeam(Request $request)
  {
      try {
          $startEndTimeByWorkingTeam = $this->workingSecurityTeamService->startEndTimeByWorkingTeam(new Carbon($request->get('date')));
          $startDay = $startEndTimeByWorkingTeam[0];
          $endDay = $startEndTimeByWorkingTeam[1];
          return response()->success('Отчет успешно получен', $request);
      
          $reportData = $this->getReportData($startDay, $endDay);
          return response()->success('Отчет успешно получен', $reportData);
      } catch (\Exception $exception) {
          return response()->error('Ошибка получения отчета', $exception->getMessage());
      }
  }

  public function getReportData($startDay, $endDay) {
    try {
      $visitors = $this->incomeVisitorService->visitorBetweenDays($startDay, $endDay);
      $cars = $this->incomeCarService->carBetweenDays($startDay, $endDay);
      $alarms = $this->incomeAlarmService->getOpenAlarms();
      $events = $this->incomeEventService->eventBetweenDays($startDay, $endDay);
      $foggotenCard = $this->incomeFoggotenCardService->cardBetweenDays($startDay, $endDay);

      $reportData = [
        'visitors' => $visitors,
        'cars' => $cars,
        'alarms' => $alarms,
        'events' => $events,
        'foggotenCard' => $foggotenCard
      ];

      return $reportData;
  } catch (\Exception $exception){
      throw new \Exception($exception->getMessage());
  }
  }
}
