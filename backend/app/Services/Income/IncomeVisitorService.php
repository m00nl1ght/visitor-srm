<?php


namespace App\Services\Income;


use App\Models\Income\IncomeVisitor;
use Carbon\Carbon;

class IncomeVisitorService
{
    //получение списка посетителей на территории
    public function getVisitorsOnTerrytory()
    {
      try {
        $onTerritory = IncomeVisitor::where('out_time', null)
        ->with(['visitor.firm', 'employee', 'security'])
        ->get();

        return $onTerritory;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //регистрация посетителя
    public function inVisitor($visitor, $security, $employee, $data) {
      try {
        $incomeVisitor = new IncomeVisitor();
        $incomeVisitor->security_id = $security->id;
        $incomeVisitor->employee_id = $employee->id;
        $incomeVisitor->visitor_id = $visitor->id;
        $incomeVisitor->card_id = $data->card_id;
        $incomeVisitor->visitor_category_id = $data->category_id;
        $incomeVisitor->in_time = Carbon::now();
  
        $incomeVisitor->save();
  
        return IncomeVisitor::where('id', $incomeVisitor->id)->with(['visitor.firm', 'employee'])->first();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }

    }

    //выход посетителя
    public function outVisitor($data) {
      try {
        $incomeVisitor = IncomeVisitor::where('id', $data->id)->first();
        $incomeVisitor->out_time = $data->out_time ? $data->out_time : Carbon::now();
        $incomeVisitor->save();
        
        return $incomeVisitor;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //получение ИД карты у посетителя
    public function getCardId($id) {
      try {
        $cardId = IncomeVisitor::where('id', $id)->first();

        return $cardId->card_id;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //получение посетителей за заданные диапазон
    public function visitorBetweenDays($startDay, $endDay) {
      try {
        $visitors = IncomeVisitor::whereBetween('in_time', array($startDay, $endDay))->with(['visitor_category', 'visitor'])->get();
        return $visitors;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
