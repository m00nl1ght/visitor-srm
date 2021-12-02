<?php

namespace App\Services\Income;


use App\Models\Income\SystemAlarmList;

class SystemAlarmListService
{
    //получение списка категорий охранных систем
    public function getSystemAlarmList()
    {
      try {
        $systemAlarmList = SystemAlarmList::all();

        return $systemAlarmList;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
