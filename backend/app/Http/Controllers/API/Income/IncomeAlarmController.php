<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\IncomeAlarmService;

class IncomeAlarmController extends Controller
{
  private $IncomeAlarmService;

  public function __construct
  (
    IncomeAlarmService $incomeAlarmService
  )
  {
      $this->incomeAlarmService = $incomeAlarmService;
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
        return response()->success('Список открытых неисправностей получен', $openAlarms);
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
          $incomeAlarm = $this->incomeAlarmService->storeAlarm($request);
          return response()->success('Событие добавлено успешно', $incomeAlarm);
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
        $incomeAlarm = $this->incomeAlarmService->showEvent($id);
        return response()->success('Событие получено успешно', $incomeAlarm);
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
        return response()->success('Событие обновлено успешно', $alarm);
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
        $alarm = $this->incomeAlarmService->deleteAlarm($id);
        return response()->success('Событие обновлено удалено', $alarm);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
    }

    public function closeAlarm(Request $request)
    {
      try {
        $alarm = $this->incomeAlarmService->closeAlarm($request);
        return response()->success('Событие обновлено успешно', $alarm);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
      
    }
}
