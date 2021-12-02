<?php

namespace App\Services\People;

use App\Models\People\Position;

class PositionService
{

  // Получение списка должностей
  public function getPositions()
  {
      try {
          $positions = Position::get();
          return $positions;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
  }

    // Создание роли для сотрудника охраны
    public function getOrCreate($position)
    {
      try {
        $pos = Position::where('position', $position)->first();
        if(!$pos) {
          $pos = new Position();
          $pos->position = $position;
          $pos->save();
        }

        return $pos;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    // // Обновление роли для сотрудника охраны
    // public function updateRoleSecurity($data, $id)
    // {
    //     try {
    //         $roleSecurity = new RoleSecurityModel();
    //         $roleSecurity->exists = true;
    //         $roleSecurity->id = $id;
    //         $roleSecurity->title = $data->title;
    //         $roleSecurity->save();
    //         return $roleSecurity;
    //     } catch (\Exception $exception){
    //         throw new \Exception($exception->getMessage());
    //     }
    // }
}
