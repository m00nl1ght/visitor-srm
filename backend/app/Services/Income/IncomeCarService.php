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
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //регистрация посетителя
  public function enterCar($data)
  {
    try {
      $incomeCar = new IncomeCar();
      $incomeCar->security_id = $data['securityId'];
      $incomeCar->employee_id = $data['employeeId'];
      $incomeCar->visitor_id = $data['visitorId'];
      $incomeCar->visitor_category_id = $data['categoryId'];
      $incomeCar->in_time = Carbon::now();
      $incomeCar->save();

      $incomeCar->security_teams()->sync($data['securityTeamId']);

      return IncomeCar::where('id', $incomeCar->id)->with(['visitor.firm', 'visitor.car', 'employee', 'security'])->first();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function leaveCar($data)
  {
    try {
      $incomeCar = IncomeCar::where('id', $data->id)->first();
      $incomeCar->out_time = $data->out_time ? $data->out_time : Carbon::now();
      $incomeCar->save();
      return $incomeCar;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getBySecurityTeam($teamId)
  {
    try {
      $alarm = IncomeCar::whereRelation(
        'security_teams',
        'security_team_id',
        '=',
        $teamId
      )->get();
      return $alarm;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
