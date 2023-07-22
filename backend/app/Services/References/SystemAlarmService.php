<?php

namespace App\Services\References;

use App\Models\References\SystemAlarm;
// use Carbon\Carbon;

class SystemAlarmService
{
  public function getList()
  {
    try {
      $systems = SystemAlarm::get();
      return $systems;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
