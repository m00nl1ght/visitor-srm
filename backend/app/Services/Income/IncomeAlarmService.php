<?php

namespace App\Services\Income;

use App\Models\Income\IncomeAlarm;
use Carbon\Carbon;

class IncomeAlarmService
{
    //получение списка открытых алармов
    public function getOpenAlarms()
    {
      try {
        $openAlarm = IncomeAlarm::where('out_time', null)
          ->with(['system_alarm_list'])
          ->get();

        return $openAlarm;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function storeAlarm($data) {
      try {
        $alarm = new IncomeAlarm();
        $alarm->title = $data->title;
        $alarm->place = $data->place ? $data->place : null;
        $alarm->comment = $data->comment ? $data->comment : null;
        $alarm->system_alarm_list_id = $data->system_alarm_list_id;
        $alarm->in_time = $data->in_time ? $data->in_time : Carbon::now();

        $alarm->save();

        return $alarm->where('out_time', null)->with('system_alarm_list')->get();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
    
    public function showEvent($id) {
      try {
        $alarm = IncomeAlarm::where('id', $id)->first();
        return $alarm;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function updateAlarm($id, $data) {
      try {
        $alarm = IncomeAlarm::where('id', $id)->first();
        $alarm->title = $data->title;
        if($data->place) $alarm->place = $data->place;
        if($alarm->comment) $alarm->comment = $data->comment;
        $alarm->system_alarm_list_id = $data->system_alarm_list_id;
        $alarm->save();

        return $alarm->where('out_time', null)->with('system_alarm_list')->get();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function deleteAlarm($id) {
      try {
        IncomeAlarm::where('id', $id)->first()->delete();
        return IncomeAlarm::where('out_time', null)->with('system_alarm_list')->get();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function closeAlarm($data) {
      try {
        $alarm = IncomeAlarm::where('id', $data->id)->first();
        $alarm->out_time = $data->out_time ? $data->out_time : Carbon::now();
        $alarm->save();

        return $alarm->where('id', $data->id)->with('system_alarm_list')->first();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function alarmBetweenDays($startDay, $endDay) {
      try {
        $alarm = IncomeAlarm::whereBetween('in_time', array($startDay, $endDay))->orWhere('out_time', null)->with(['system_alarm_list'])->get();
        return $alarm;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
