<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\SecurityMail;

use Carbon\Carbon;

use App\Services\Security\SecurityTeamService;
use App\Services\Income\IncomeVisitorService;
use App\Services\Income\IncomeCarService;
use App\Services\Income\IncomeAlarmService;
use App\Services\Income\IncomeEventService;
use App\Services\Income\IncomeFoggotenCardService;

class SecurityTeamReportController extends Controller
{
  private $securityTeamService;
  private $incomeVisitorService;
  private $incomeCarService;
  private $incomeAlarmService;
  private $incomeEventService;
  private $incomeFoggotenCardService;

  public function __construct(
    SecurityTeamService $securityTeamService,
    IncomeVisitorService $incomeVisitorService,
    IncomeCarService $incomeCarService,
    IncomeAlarmService $incomeAlarmService,
    IncomeEventService $incomeEventService,
    IncomeFoggotenCardService $incomeFoggotenCardService
  ) {
    $this->securityTeamService = $securityTeamService;
    $this->incomeVisitorService = $incomeVisitorService;
    $this->incomeCarService = $incomeCarService;
    $this->incomeAlarmService = $incomeAlarmService;
    $this->incomeEventService = $incomeEventService;
    $this->incomeFoggotenCardService = $incomeFoggotenCardService;
  }


  public function getReportData($teamId)
  {
    try {
      $data = $this->securityTeamService->reportDataById($teamId);

      $reportData = [
        'visitors' => $data->income_visitors,
        'cars' => $data->income_cars,
        'alarms' => $data->income_alarms,
        'events' => $data->income_events,
        'foggotenCard' => $data->income_foggoten_cards
      ];

      return $reportData;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }


  public function bySecurityTeam(Request $request)
  {
    try {
      $teamId = $request->query('id');
      if (!$teamId) {
        $teamId =  $this->securityTeamService->getActive()->id;
      }

      $reportData = $this->getReportData($teamId);
      return response($reportData);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  private function flatSecurities($securities)
  {
    function getName($arr)
    {
      return $arr['last_name'] . ' ' .  $arr['name'] . ' ' . $arr['middle_name'];
    }

    $result = [];
    $result[] = getName($securities['operator']);
    $result[] = getName($securities['chief']);

    foreach ($securities['securities'] as $arr) {
      $result[] = getName($arr);
    }

    return $result;
  }

  private function countCategories($report)
  {
    $result = [];
    $result['Всего'] = $report->count();

    foreach ($report as $arr) {
      $key = $arr->visitor_category->title;

      if (isset($result[$key])) {
        $result[$arr->visitor_category->title]++;
      } else {
        $result[$arr->visitor_category->title] = 1;
      }
    }

    return $result;
  }


  public function sendSecurityTeamReport(Request $request)
  {
    try {
      $securityTeam = null;
      $teamId = $request->query('id');

      if (!$teamId) {
        $securityTeam =  $this->securityTeamService->getActive();
        $teamId = $securityTeam->id;
      } else {
        $securityTeam = $this->securityTeamService->getOne($teamId);
      }

      $visitors = $this->incomeVisitorService->getBySecurityTeam($teamId);
      $cars = $this->incomeCarService->getBySecurityTeam($teamId);
      $alarms = $this->incomeAlarmService->getBySecurityTeam($teamId);
      $events = $this->incomeEventService->getBySecurityTeam($teamId);
      $foggotenCard = $this->incomeFoggotenCardService->getBySecurityTeam($teamId);

      $countPeopleArr = $this->countCategories($visitors);
      $countCarArr = $this->countCategories($cars);

      $reportData = [
        // $reportData['reportDayTomorrow']->format('d.m.Y') TODO Format date
        'reportDay' => '',
        'reportDayTomorrow' => '',
        'visitors' => $visitors,
        'cars' => $cars,
        'alarms' => $alarms,
        'events' => $events,
        'foggotenCard' => $foggotenCard,
        'securities' => $this->flatSecurities($securityTeam),
        'visitorsCount' => $countPeopleArr,
        'carsCount' => $countCarArr
      ];

      $toEmail = explode(',', env('MAIL_SECURITY_REPORT_RECIVERS'));
      Mail::to($toEmail)->send(new SecurityMail($reportData));

      return view('emails.reportSecurity', compact('reportData'));
      // return response()->success('Отчет успешно отправлен', $reportData);
    } catch (\Exception $exception) {
      return response()->error('Ошибка отправки отчета', $exception->getMessage());
    }
  }
}

// <?php

// namespace App\Http\Controllers\API\Report;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use Carbon\Carbon;

// use App\Mail\SecurityMail;

// use App\Services\Income\IncomeVisitorService;
// use App\Services\Income\IncomeCarService;
// use App\Services\Income\IncomeAlarmService;
// use App\Services\Income\IncomeEventService;
// use App\Services\Income\IncomeFoggotenCardService;


// class ReportController extends Controller
// {
//   private $workingSecurityTeamService;
//   private $incomeVisitorService;
//   private $incomeCarService;
//   private $incomeAlarmService;
//   private $incomeEventService;
//   private $incomeFoggotenCardService;

//   public function __construct(
//     IncomeVisitorService $incomeVisitorService,
//     IncomeCarService $incomeCarService,
//     IncomeAlarmService $incomeAlarmService,
//     IncomeEventService $incomeEventService,
//     IncomeFoggotenCardService $incomeFoggotenCardService
//   ) {
//     $this->incomeVisitorService = $incomeVisitorService;
//     $this->incomeCarService = $incomeCarService;
//     $this->incomeAlarmService = $incomeAlarmService;
//     $this->incomeEventService = $incomeEventService;
//     $this->incomeFoggotenCardService = $incomeFoggotenCardService;
//   }

//   public function getReportData($startDay, $endDay)
//   {
//     try {
//       $visitors = $this->incomeVisitorService->visitorBetweenDays($startDay, $endDay);
//       $cars = $this->incomeCarService->carBetweenDays($startDay, $endDay);
//       $alarms = $this->incomeAlarmService->alarmBetweenDays($startDay, $endDay);
//       $events = $this->incomeEventService->eventBetweenDays($startDay, $endDay);
//       $foggotenCard = $this->incomeFoggotenCardService->cardBetweenDays($startDay, $endDay);

//       $reportData = [
//         'visitors' => $visitors,
//         'cars' => $cars,
//         'alarms' => $alarms,
//         'events' => $events,
//         'foggotenCard' => $foggotenCard
//       ];

//       return $reportData;
//     } catch (\Exception $exception) {
//       throw new \Exception($exception->getMessage());
//     }
//   }

//   public function byDay(Request $request)
//   {
//     try {
//       $startDay = new Carbon($request->get('date'));
//       $endDay = new Carbon($request->date);
//       $endDay->addDays(1);

//       $reportData = $this->getReportData($startDay, $endDay);

//       return response()->success('Отчет успешно получен', $reportData);
//     } catch (\Exception $exception) {
//       return response()->error('Ошибка получения отчета', $exception->getMessage());
//     }
//   }

//   public function bySecurityTeam(Request $request)
//   {
//     try {
//       $reportDay = Carbon::create($request->get('date'));
//       $reportDay->addDay();

//       $startEndTimeByWorkingTeam = $this->workingSecurityTeamService->startEndTimeByWorkingTeam($reportDay);

//       $startDay = $startEndTimeByWorkingTeam[0];
//       $endDay = $startEndTimeByWorkingTeam[1];

//       // При регистрации новой смены не пропадают происшествия от предыдущей смены. 

//       // надо еще апишки ролей сделать (админ, Ширяев, охрана), чтобы шаблоны разные были и возможности для устройств

//       $reportData = $this->getReportData($startDay, $endDay);
//       return response()->success('Отчет успешно получен', $reportData);
//     } catch (\Exception $exception) {
//       return response()->error('Ошибка получения отчета', $exception->getMessage());
//     }
//   }

//   public function byDuration(Request $request)
//   {
//     try {
//       $startDay = $request->input('start');
//       $endDay = $request->input('end');

//       $reportData = $this->getReportData($startDay, $endDay);
//       return response()->success('Отчет успешно получен', $reportData);
//     } catch (\Exception $exception) {
//       return response()->error('Ошибка получения отчета', $exception->getMessage());
//     }
//   }

//   public function sendSecurityTeamReport()
//   {
//     try {
//       $startEndTimeByWorkingTeam = $this->workingSecurityTeamService->startEndTimeByWorkingTeam(new Carbon());
//       $startDay = $startEndTimeByWorkingTeam[0];
//       $endDay = $startEndTimeByWorkingTeam[1];

//       $reportData = $this->getReportData($startDay, $endDay);
//       $securities = $this->workingSecurityTeamService->getLastWorkingSecurityTeam();

//       $countPeopleArr = $this->countCategories($reportData['visitors']);
//       $countCarArr = $this->countCategories($reportData['cars']);

//       $reportData['securities'] = $this->flatSecurities($securities);
//       $reportData['reportDay'] = $startDay;
//       $reportData['reportDayTomorrow'] = $endDay;
//       $reportData['securityGuys'] = [];
//       $reportData['visitorsCount'] = $countPeopleArr;
//       $reportData['carsCount'] = $countCarArr;

//       $toEmail = explode(',', env('MAIL_SECURITY_REPORT_RECIVERS'));
//       Mail::to($toEmail)->send(new SecurityMail($reportData));

//       // return view('emails.reportSecurity', compact('reportData'));
//       return response()->success('Отчет успешно отправлен', $reportData);
//     } catch (\Exception $exception) {
//       return response()->error('Ошибка отправки отчета', $exception->getMessage());
//     }
//   }
// }
