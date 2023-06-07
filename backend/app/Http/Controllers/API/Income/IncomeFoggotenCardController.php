<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeFoggotenCardService;
use App\Services\People\EmployeeService;
use App\Services\People\PositionService;
use App\Services\Card\CardService;

class IncomeFoggotenCardController extends Controller
{
  private $incomeFoggotenCardService;
  private $employeeService;
  private $positionService;
  private $cardService;

  public function __construct
  (
    IncomeFoggotenCardService $incomeFoggotenCardService,
    EmployeeService $employeeService,
    PositionService $positionService,
    CardService $cardService
  )
  {
      $this->incomeFoggotenCardService = $incomeFoggotenCardService;
      $this->employeeService = $employeeService;
      $this->positionService = $positionService;
      $this->cardService = $cardService;
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
        return response()->success('Список успешно получен', $list);
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
        //сотрудник
        $employee = $this->employeeService->getByFullName($request->employee);
        $position = $this->positionService->getOrCreate($request->employee['position']);

        if(!$employee) {
          $employee = $this->employeeService->createEmployee($request->employee, $position->id);
        } else {
          $employee = $this->employeeService->setPosition($employee->id, $position->id);
        }

        //руководитель сотрудника
        $boss = $this->employeeService->getByFullName($request->boss);
        $bossPosition = $this->positionService->getOrCreate($request->boss['position']);
        if(!$boss) {
          $boss = $this->employeeService->createEmployee($request->boss, $bossPosition->id);
        } else {
          $boss = $this->employeeService->setPosition($boss->id, $bossPosition->id);
        }

        //сменить статус карты
        $this->cardService->changeStatus($request->card_id, true);

        //выдать карту сотруднику
        $incomeFoggotenCard = $this->incomeFoggotenCardService->setIssuedCard(
          $employee->id,
          $boss->id,
          $request->card_id
        );

        return response()->success('Карта успешно выдана');
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
        return response()->success('Карта успешно вернута');
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
        $incomeFoggotenCard = $this->incomeFoggotenCardService->deleteIncomeCard($id);
        $this->cardService->changeStatus($incomeFoggotenCard->card_id, false);
        return response()->success('Карта успешно удалена');
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
    }
}
