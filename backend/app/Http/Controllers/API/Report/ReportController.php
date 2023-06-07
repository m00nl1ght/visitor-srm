<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Mail\SecurityMail;

use App\Services\Income\IncomeVisitorService;
use App\Services\Income\IncomeCarService;
use App\Services\Income\IncomeAlarmService;
use App\Services\Income\IncomeEventService;
use App\Services\Income\IncomeFoggotenCardService;

use App\Services\WorkingSecurityTeam\WorkingSecurityTeamService;

class ReportController extends Controller
{
  private $workingSecurityTeamService;
  private $incomeVisitorService;
  private $incomeCarService;
  private $incomeAlarmService;
  private $incomeEventService;
  private $incomeFoggotenCardService;

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

  public function getReportData($startDay, $endDay) {
    try {
      $visitors = $this->incomeVisitorService->visitorBetweenDays($startDay, $endDay);
      $cars = $this->incomeCarService->carBetweenDays($startDay, $endDay);
      $alarms = $this->incomeAlarmService->alarmBetweenDays($startDay, $endDay);
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
      
          $reportData = $this->getReportData($startDay, $endDay);
          return response()->success('Отчет успешно получен', $reportData);
      } catch (\Exception $exception) {
          return response()->error('Ошибка получения отчета', $exception->getMessage());
      }
  }

  public function byDuration(Request $request)
  {
      try {
          $startDay = $request->input('start');
          $endDay = $request->input('end');

          $reportData = $this->getReportData($startDay, $endDay);
          return response()->success('Отчет успешно получен', $reportData);
      } catch (\Exception $exception) {
          return response()->error('Ошибка получения отчета', $exception->getMessage());
      }
  }

  public function sendSecurityTeamReport() {
    try {
      $startEndTimeByWorkingTeam = $this->workingSecurityTeamService->startEndTimeByWorkingTeam(new Carbon());
      $startDay = $startEndTimeByWorkingTeam[0];
      $endDay = $startEndTimeByWorkingTeam[1];

      $reportData = $this->getReportData($startDay, $endDay);
      $reportData['reportDay'] = $startDay;
      $reportData['reportDayTomorrow'] = $endDay;
      $reportData['securityGuys'] = []; 

      $toEmail = explode(',', env('MAIL_SECURITY_REPORT_RECIVERS'));
      Mail::to($toEmail)->send(new SecurityMail($reportData));

      // return view('emails.reportSecurity', compact('reportData'));
      return response()->success('Отчет успешно отправлен', $reportData);
    } catch (\Exception $exception) {
        return response()->error('Ошибка отправки отчета', $exception->getMessage());
    }
  }
}
