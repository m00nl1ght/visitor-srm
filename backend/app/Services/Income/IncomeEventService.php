<?php

namespace App\Services\Income;

use App\Models\Income\IncomeEvent;
use Carbon\Carbon;

class IncomeEventService
{
  //получение списка открытых проишествий
  public function getEvent()
  {
    try {
      return IncomeEvent::get();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  //получение списка открытых проишествий
  public function storeEvent($data, $securityTeamId)
  {
    try {
      $event = new IncomeEvent();
      $event->description = $data->description;
      $event->comment = $data->comment ? $data->comment : null;
      $event->in_time = $data->in_time ? $data->in_time : Carbon::now();
      $event->save();

      $event->security_teams()->sync($securityTeamId);

      return $event;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function showEvent($id)
  {
    try {
      $event = IncomeEvent::where('id', $id)->first();
      return $event;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function updateEvent($id, $data)
  {
    try {
      $event = IncomeEvent::where('id', $id)->first();
      $event->description = $data->description;
      $event->comment = $data->comment ? $data->comment : null;
      $event->in_time = $data->in_time ? new Carbon($data->in_time) : Carbon::now();
      $event->save();

      return $event;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function deleteEvent($id)
  {
    try {
      IncomeEvent::where('id', $id)->first()->delete();
      return IncomeEvent::get();
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getBySecurityTeam($teamId)
  {
    try {
      $alarm = IncomeEvent::whereRelation(
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
