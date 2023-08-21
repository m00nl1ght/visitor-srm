<?php

namespace App\Services\Income;

use App\Models\Income\SystemAlarmList as SystemAlarmListModel;

class SystemAlarmListService
{
    //получение списка категорий охранных систем
    public function getSystemAlarmList()
    {
        try {
            return SystemAlarmListModel::all();

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
