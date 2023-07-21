<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeCarService;
use App\Services\Firm\FirmService;
use App\Services\Visitor\VisitorService;
use App\Services\People\EmployeeService;
use App\Services\Security\SecurityService;
use App\Services\Car\CarService;
use App\Services\Car\CarModelService;
use App\Services\Security\SecurityTeamService;

class IncomeCarController extends Controller
{
  private $incomeCarService;
  private $firmService;
  private $visitorService;
  private $employeeService;
  private $securityService;
  private $carService;
  private $carModelService;
  private $securityTeamService;

  public function __construct(
    IncomeCarService $incomeCarService,
    FirmService $firmService,
    VisitorService $visitorService,
    EmployeeService $employeeService,
    SecurityService $securityService,
    CarService $carService,
    CarModelService $carModelService,
    SecurityTeamService $securityTeamService,
  ) {
    $this->incomeCarService = $incomeCarService;
    $this->firmService = $firmService;
    $this->visitorService = $visitorService;
    $this->employeeService = $employeeService;
    $this->securityService = $securityService;
    $this->carService = $carService;
    $this->carModelService = $carModelService;
    $this->securityTeamService = $securityTeamService;
  }
  /**
   * Registrate income car
   * @param  \Illuminate\Http\Request  $request
   * 
   * @return \Illuminate\Http\Response
   */
  public function enterTerritory(Request $request)
  {
    try {
      //фирма
      $firm = $request->visitor['firm'] && strlen($request->visitor['firm']) > 0
        ? $this->firmService->createOrGetFirm($request->visitor['firm'])
        : null;

      //автомобиль
      $carModel = $this->carModelService->getOrCreate($request->car['model']);
      $car = $this->carService->getOrCreate($request->car['number'], $carModel->id);

      // посетитель
      $visitor = $this->visitorService->getVisitorByFullName($request->visitor);
      $params = [
        'firm_id' => $firm->id,
        'car_id' => $car->id
      ];
      if (!$visitor) {
        $visitor = $this->visitorService->createVisitor($request->visitor, $params);
      } else {
        $visitor = $this->visitorService->updateVisitor($visitor, $request->visitor, $params);
      }

      //сотрудник
      $employee = $this->employeeService->getByFullName($request->employee);
      if (!$employee) {
        $employee = $this->employeeService->createEmployee($request->employee);
      }

      // //охрана
      $security = $this->securityService->getSecurityById($request->security_id);

      // //регистрируем посетителя
      $securityTeam = $this->securityTeamService->getActive();
      $data = [
        "visitorId" => $visitor->id,
        "securityId" => $security->id,
        "employeeId" => $employee->id,
        "categoryId" => $request->category_id,
        "securityTeamId" => $securityTeam->id
      ];
      $incomeCar = $this->incomeCarService->enterCar($data);

      return response()->success('Автомобиль успешно зарегистрирован', $incomeCar);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }

  /**
   * Registrate outcome car
   * @param  \Illuminate\Http\Request  $request
   * 
   * @return \Illuminate\Http\Response
   */
  public function leaveTerritory(Request $request)
  {
    try {
      $outCar = $this->incomeCarService->leaveCar($request);
      return response()->success('Автомобиль покинул территорию', $outCar);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }

  /**
   * Show income car on terrytory
   * 
   * @return \Illuminate\Http\Response
   */
  public function onTerritory(Request $request)
  {
    try {
      $onTerrytory = $this->incomeCarService->getCarsOnTerrytory();
      return response()->success('Список автомобилей получен успешно', $onTerrytory);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }
}
