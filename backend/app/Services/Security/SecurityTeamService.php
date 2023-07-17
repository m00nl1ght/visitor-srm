<?php

namespace App\Services\Security;

use App\Helpers\GetDateHelper;
// use App\Models\Security\SecurityTeam as SecurityTeamModel;
use App\Models\Security\SecurityTeam as SecurityTeamModel;

use Carbon\Carbon;

class SecurityTeamService
{
  private $getDateHelper;

  public function __construct(GetDateHelper $getDateHelper)
  {
    $this->getDateHelper = $getDateHelper;
  }

  // Получение всех связей рабочей смены охраны
  private function getAllCollections($workingSecurityTeam)
  {
    try {
      return $workingSecurityTeam
        ->load('operator')
        ->load('chief')
        ->load('securities');
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Получение списка рабочих смен охраны
  public function getList()
  {
    try {
      $teams = SecurityTeamModel::get();
      return $this->getAllCollections($teams);
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }


  // Создание рабочей группы охраны
  public function createSecurityTeam($data, $securities)
  {
    try {
      $workingSecurityTeam = new SecurityTeamModel();
      $workingSecurityTeam->chief_id = $data->chief_id;
      $workingSecurityTeam->operator_id = $data->operator_id;

      $workingSecurityTeam->save();
      $workingSecurityTeam->securities()->attach($securities);

      return $this->getAllCollections($workingSecurityTeam);
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Обновление рабочей смены охраны
  public function updateSecurityTeam($data, $id)
  {
    try {
      $workingSecurityTeam = SecurityTeamModel::find($id);
      if ($workingSecurityTeam) {
        $workingSecurityTeam->chief_id = $data->chief_id;
        $workingSecurityTeam->operator_id = $data->operator_id;
        $workingSecurityTeam->update();

        return $this->getAllCollections($workingSecurityTeam);
      }
      throw new \Exception('c id ' . $id . ' смены охраны не найдено');
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Обновление списка охранников в рабочей смене охраны
  public function updatingSecuritiesListOfSecurityTeam($securitiesId, $workingSecurityTeamId)
  {
    try {
      $workingSecurityTeam = SecurityTeamModel::find($workingSecurityTeamId);
      if ($workingSecurityTeam) {
        return $workingSecurityTeam->securities()->sync($securitiesId);
      }
      throw new \Exception('c id ' . $workingSecurityTeamId . ' смены охраны не найдено');
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getActive()
  {
    try {
      $active = SecurityTeamModel::get()->last();
      return $active;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //получение посетителей за смену охраны
  public function reportDataById($securityTeamId)
  {
    try {
      $data = SecurityTeamModel::where('id', $securityTeamId)
        ->with(['income_visitors', 'income_cars', 'income_events', 'income_alarms'])
        ->first();
      return $data;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }


  // // Получение рабочей группы по id
  // public function getWorkingSecurityTeamById($id)
  // {
  //   try {
  //     $workingSecurityTeam = SecurityTeamModel::where('id', $id)->first();
  //     if ($workingSecurityTeam) {

  //       return $this->getAllCollections($workingSecurityTeam);
  //     }
  //     throw new \Exception('c id ' . $id . ' рабочей смены охраны не найдено');
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }

  // // Получение активной рабочей смены охраны
  // public function getCurrentSecurityTeam($setting)
  // {
  //   try {
  //     $workingSecurityTeam = SecurityTeamModel::orderBy('id', 'desc')->first();
  //     $teamTimestamp = $workingSecurityTeam->created_at->getTimestamp();
  //     $timeStart = $this->getDateHelper->parseTime($setting->time_start);
  //     $startTeamTimestamp = $this->getDateHelper->getTodayTimestamp($timeStart->hours, $timeStart->minutes);
  //     $range = 3600 * $setting->duration;
  //     $currentTimestamp = $this->getDateHelper->currentTimestamp();

  //     if ($currentTimestamp > $startTeamTimestamp) {
  //       $endTeamTimestamp = $startTeamTimestamp + $range;
  //       if ($startTeamTimestamp < $teamTimestamp && $teamTimestamp < $endTeamTimestamp) {

  //         return $this->getAllCollections($workingSecurityTeam);
  //       }
  //       return null;
  //     }
  //     if ($currentTimestamp < $startTeamTimestamp) {
  //       $endTeamTimestamp = $startTeamTimestamp;
  //       if ($endTeamTimestamp > $teamTimestamp && $startTeamTimestamp - $range < $teamTimestamp) {

  //         return $this->getAllCollections($workingSecurityTeam);
  //       }
  //       return null;
  //     }
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }



  // Удаление рабочей смены охраны
  // public function deleteWorkingSecurityTeam($id)
  // {
  //   try {
  //     $workingSecurityTeam = new SecurityTeamModel();
  //     $workingSecurityTeam->exists = true;
  //     $workingSecurityTeam->id = $id;
  //     $workingSecurityTeam->delete();
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }



  // // Получение последней зарегестрированной смены
  // public function getLastWorkingSecurityTeam()
  // {
  //   try {
  //     $workingSecurityTeam = SecurityTeamModel::latest()->first();
  //     return $this->getAllCollections($workingSecurityTeam);
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }

  // //получение диапазона работы смены
  // public function startEndTimeByWorkingTeam($date)
  // {
  //   try {
  //     $startDay = SecurityTeamModel::whereDate('created_at', "<", $date)->latest()->first();
  //     if (!$startDay) throw new \Exception('За текущую дату отчета не найдено' . $date);

  //     $startDay = $startDay->created_at;
  //     $endDay = SecurityTeamModel::whereDate('created_at', ">", $startDay)->first();
  //     if (!$endDay) $endDay = Carbon::now();
  //     else $endDay = $endDay->created_at;

  //     return [$startDay, $endDay];
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }

  // //получение смены по дате
  // public function getWorkingTeamByDate($date)
  // {
  //   try {
  //     $team = SecurityTeamModel::whereDate('created_at', "<", $date)->latest()->first();
  //     if (!$team) throw new \Exception('За текущую дату отчета не найдено' . $date);
  //     return $team;
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }
}
