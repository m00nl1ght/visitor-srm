<?php
namespace App\Services\Income;


use App\Models\Income\IncomeCar;
use Carbon\Carbon;

class IncomeCarService
{
    //получение списка посетителей на территории
    public function getCarsOnTerrytory()
    {
      try {
        $onTerritory = IncomeCar::where('out_time', null)
          ->with(['visitor.firm', 'visitor.car', 'employee', 'security'])
          ->get();

        return $onTerritory;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //регистрация посетителя
    public function inCar($request, $visitor, $security, $employee) {
      try {
        $incomeCar = new IncomeCar();
        $incomeCar->security_id = $security->id;
        $incomeCar->employee_id = $employee->id;
        $incomeCar->visitor_id = $visitor->id;
        $incomeCar->visitor_category_id = $request->category_id;
        $incomeCar->in_time = Carbon::now();
        $incomeCar->save();
  
        return IncomeCar::where('id', $incomeCar->id)->with(['visitor.firm', 'employee'])->first();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function outCar($data) {
      try {
        $incomeCar = IncomeCar::where('id', $data->id)->first();
        $incomeCar->out_time = $data->out_time ? $data->out_time : Carbon::now();
        $incomeCar->save();
        return $incomeCar;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //получение посетителей за заданные диапазон
    public function carBetweenDays($startDay, $endDay) {
      try {
        $visitors = IncomeCar::whereBetween('in_time', array($startDay, $endDay))->with(['visitor_category', 'visitor'])->get();
        return $visitors;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
