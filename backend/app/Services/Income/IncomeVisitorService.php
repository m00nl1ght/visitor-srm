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
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //регистрация посетителя
  public function enterVisitor($data)
  {
    try {
      $incomeVisitor = new IncomeVisitor();
      $incomeVisitor->security_id = $data['securityId'];
      $incomeVisitor->employee_id = $data['employeeId'];
      $incomeVisitor->visitor_id = $data['visitorId'];
      $incomeVisitor->card_id = $data['cardId'];
      $incomeVisitor->visitor_category_id = $data['categoryId'];
      $incomeVisitor->in_time = Carbon::now();

      $incomeVisitor->save();

      $incomeVisitor->security_teams()->sync($data['securityTeamId']);

      return IncomeVisitor::where('id', $incomeVisitor->id)->with(['visitor.firm', 'employee'])->first();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //выход посетителя
  public function leaveVisitor($data)
  {
    try {
      $incomeVisitor = IncomeVisitor::where('id', $data->id)->first();
      $incomeVisitor->out_time = $data->out_time ? $data->out_time : Carbon::now();
      $incomeVisitor->save();

      return $incomeVisitor;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //получение ИД карты у посетителя
  public function getCardId($id)
  {
    try {
      $cardId = IncomeVisitor::where('id', $id)->first();

      return $cardId->card_id;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getBySecurityTeam($teamId)
  {
    try {
      $alarm = IncomeVisitor::whereRelation(
        'security_teams',
        'security_team_id',
        '=',
        $teamId
      )
        ->get();
      return $alarm;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
