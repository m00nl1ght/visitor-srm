<?php


namespace App\Services\WorkingSecurityTeam;


use App\Helpers\GetDateHelper;
use App\Models\WorkingSecurityTeam\WorkingSecurityTeam as WorkingSecurityTeamModel;

use Carbon\Carbon;

class WorkingSecurityTeamService
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

  // Создание рабочей группы охраны
  public function createWorkingSecurityTeam($data, $securities)
  {
    try {
      $workingSecurityTeam = new WorkingSecurityTeamModel();
      $workingSecurityTeam->chief_id = $data->chief_id;
      $workingSecurityTeam->operator_id = $data->operator_id;

      $workingSecurityTeam->save();
      $workingSecurityTeam->securities()->attach($securities);

      return $this->getAllCollections($workingSecurityTeam);
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Получение рабочей группы по id
  public function getWorkingSecurityTeamById($id)
  {
    try {
      $workingSecurityTeam = WorkingSecurityTeamModel::where('id', $id)->first();
      if ($workingSecurityTeam) {

        return $this->getAllCollections($workingSecurityTeam);
      }
      throw new \Exception('c id ' . $id . ' рабочей смены охраны не найдено');
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Получение активной рабочей смены охраны
  public function getCurrentSecurityTeam($setting)
  {
    try {
      $workingSecurityTeam = WorkingSecurityTeamModel::orderBy('id', 'desc')->first();
      $teamTimestamp = $workingSecurityTeam->created_at->getTimestamp();
      $timeStart = $this->getDateHelper->parseTime($setting->time_start);
      $startTeamTimestamp = $this->getDateHelper->getTodayTimestamp($timeStart->hours, $timeStart->minutes);
      $range = 3600 * $setting->duration;
      $currentTimestamp = $this->getDateHelper->currentTimestamp();

      if ($currentTimestamp > $startTeamTimestamp) {
        $endTeamTimestamp = $startTeamTimestamp + $range;
        if ($startTeamTimestamp < $teamTimestamp && $teamTimestamp < $endTeamTimestamp) {

          return $this->getAllCollections($workingSecurityTeam);
        }
        return null;
      }
      if ($currentTimestamp < $startTeamTimestamp) {
        $endTeamTimestamp = $startTeamTimestamp;
        if ($endTeamTimestamp > $teamTimestamp && $startTeamTimestamp - $range < $teamTimestamp) {

          return $this->getAllCollections($workingSecurityTeam);
        }
        return null;
      }
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Получение списка рабочих смен охраны
  public function getListWorkingSecurityTeams()
  {
    try {
      $workingSecuritiesTeams = WorkingSecurityTeamModel::all();

      return $this->getAllCollections($workingSecuritiesTeams);
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Удаление рабочей смены охраны
  public function deleteWorkingSecurityTeam($id)
  {
    try {
      $workingSecurityTeam = new WorkingSecurityTeamModel();
      $workingSecurityTeam->exists = true;
      $workingSecurityTeam->id = $id;
      $workingSecurityTeam->delete();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Обновление рабочей смены охраны
  public function updateWorkingSecurityTeam($data, $id)
  {
    try {
      $workingSecurityTeam = WorkingSecurityTeamModel::find($id);
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
  public function updatingSecuritiesListOfWorkingSecurityTeam($securitiesId, $workingSecurityTeamId)
  {
    try {
      $workingSecurityTeam = WorkingSecurityTeamModel::find($workingSecurityTeamId);
      if ($workingSecurityTeam) {
        return $workingSecurityTeam->securities()->sync($securitiesId);
      }
      throw new \Exception('c id ' . $workingSecurityTeamId . ' смены охраны не найдено');
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  // Получение последней зарегестрированной смены
  public function getLastWorkingSecurityTeam()
  {
    try {
      $workingSecurityTeam = WorkingSecurityTeamModel::latest()->first();
      return $this->getAllCollections($workingSecurityTeam);
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //получение диапазона работы смены
  public function startEndTimeByWorkingTeam($date)
  {
    try {
      $startDay = WorkingSecurityTeamModel::whereDate('created_at', "<", $date)->latest()->first();
      if (!$startDay) throw new \Exception('За текущую дату отчета не найдено' . $date);

      $startDay = $startDay->created_at;
      $endDay = WorkingSecurityTeamModel::whereDay('created_at', ">", $startDay)->first();
      if (!$endDay) $endDay = Carbon::now();
      else $endDay = $endDay->created_at;

      return [$startDay, $endDay];
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

    //получение смены по дате
    public function getWorkingTeamByDate($date)
    {
      try {
        $team = WorkingSecurityTeamModel::whereDate('created_at', "<", $date)->latest()->first();
        if (!$team) throw new \Exception('За текущую дату отчета не найдено' . $date);
        return $team;
      } catch (\Exception $exception) {
        throw new \Exception($exception->getMessage());
      }
    }
}
