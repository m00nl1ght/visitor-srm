<?php

namespace App\Services\Income;

use App\Models\Income\IncomeFoggotenCard;
use Carbon\Carbon;

class IncomeFoggotenCardService
{
  //получение списка выданных карт
  public function getIssuedCardList()
  {
    try {
      $list = IncomeFoggotenCard::where('out_time', null)
        ->with('employee')
        ->with('boss_employee')
        ->with('card')
        ->get();
      return $list;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //выдать карту
  public function setIssuedCard($data)
  {
    try {
      $incomeCard = new IncomeFoggotenCard();
      $incomeCard->employee_id = $data['employeeId'];
      $incomeCard->boss_employee_id = $data['bossId'];
      $incomeCard->card_id = $data['cardId'];
      $incomeCard->in_time = Carbon::now();
      $incomeCard->save();

      $incomeCard->security_teams()->sync($data['securityTeamId']);

      return $incomeCard;
    } catch (\Exception $exception) {
      throw new \Exception($exception);
    }
  }

  //вернуть карту
  public function returnIssuedCard($id, $outTime)
  {
    try {
      $incomeCard = IncomeFoggotenCard::where('id', $id)->first();
      if ($outTime) $incomeCard->out_time = $outTime;
      else $incomeCard->out_time = Carbon::now();
      $incomeCard->save();

      return $incomeCard;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //удалить запись выданной карты
  public function deleteIncomeCard($id)
  {
    try {
      $incomeCard = IncomeFoggotenCard::where('id', $id)->first();
      $incomeCard->delete();
      return $incomeCard;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getBySecurityTeam($teamId)
  {
    try {
      $alarm = IncomeFoggotenCard::whereRelation(
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
