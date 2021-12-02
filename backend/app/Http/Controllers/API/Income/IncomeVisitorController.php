<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeVisitorService;
use App\Services\Firm\FirmService;
use App\Services\Visitor\VisitorService;
use App\Services\People\EmployeeService;
use App\Services\Security\SecurityService;
use App\Services\Card\CardService;


class IncomeVisitorController extends Controller
{
  private $incomeVisitorService;

  public function __construct
  (
      IncomeVisitorService $incomeVisitorService,
      FirmService $firmService,
      VisitorService $visitorService,
      EmployeeService $employeeService,
      SecurityService $securityService,
      CardService $cardService
  )
  {
      $this->incomeVisitorService = $incomeVisitorService;
      $this->firmService = $firmService;
      $this->visitorService = $visitorService;
      $this->employeeService = $employeeService;
      $this->securityService = $securityService;
      $this->cardService = $cardService;
  }

    /**
     * Registrate income visitor
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function in(Request $request)
    {
      try {
        //фирма
        $firm = $request->visitor['firm'] && strlen($request->visitor['firm']) > 0
          ? $this->firmService->createOrGetFirm($request->visitor['firm'])
          : null;

        // посетитель
        $visitor = $this->visitorService->getVisitorByFullName($request->visitor);
        $params = [
          'firm_id' => $firm->id
        ];
        if(!$visitor) {
          $visitor = $this->visitorService->createVisitor($request->visitor, $params);
        } else {
          $visitor = $this->visitorService->updateVisitor($visitor, $request->visitor, $params);
        }

        //сотрудник
        $employee = $this->employeeService->getByFullName($request->employee);
        if(!$employee) {
          $employee = $this->employeeService->createEmployee($request->employee);
        }

        // //охрана
        $security = $this->securityService->getSecurityById($request->security_id);

        //карта доступа
        $this->cardService->changeStatus($request->card_id, true);

        // //регистрируем посетителя
        $incomeVisitor = $this->incomeVisitorService->inVisitor($visitor, $security, $employee, $request);

        return response()->success('Посетитель успешно зарегистрирован', $incomeVisitor);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }

    }

    /**
     * Registrate outcome visitor
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function out(Request $request)
    {
      try {
        $cardId = $this->incomeVisitorService->getCardId($request->id);
        $this->cardService->changeStatus($cardId, 0);

        $outVisitor = $this->incomeVisitorService->outVisitor($request);
        return response()->success('Посетитель вышел', $outVisitor);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
        
    }

    /**
     * Show income visitor on terrytory
     * 
     * @return \Illuminate\Http\Response
     */
    public function onTerritory(Request $request)
    {
      try {
        $onTerrytory = $this->incomeVisitorService->getVisitorsOnTerrytory();
        return response()->success('Список посетителей получен успешно', $onTerrytory);
      } catch (\Exception $exception) {
          return response()->error($exception);
      }
    }

}


