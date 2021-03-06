<?php

namespace App\Services\Income;

use App\Models\Income\IncomeEvent;
use Carbon\Carbon;

class IncomeEventService
{
  //получение списка открытых проишествий
    public function getEvent() {
      try {
        return IncomeEvent::get();
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //получение списка открытых проишествий
    public function storeEvent($data) {
      try {
        $event = new IncomeEvent();
        $event->description = $data->description;
        $event->comment = $data->comment ? $data->comment : null;
        $event->in_time = $data->in_time ? $data->in_time : Carbon::now();
        $event->save();

        return $event;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function showEvent($id) {
      try {
        $event = IncomeEvent::where('id', $id)->first();
        return $event;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function updateEvent($id, $data) {
      try {
        $event = IncomeEvent::where('id', $id)->first();
        $event->description = $data->description;
        $event->comment = $data->comment ? $data->comment : null;
        $event->in_time = $data->in_time ? new Carbon($data->in_time) : Carbon::now();
        $event->save();

        return $event;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    //получение событий за заданный промежуток
    public function eventBetweenDays($startDay, $endDay) {
      try {
        $events = IncomeEvent::whereBetween('in_time', array($startDay, $endDay))->get();
        return $events;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
