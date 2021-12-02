<?php

namespace App\Services\People;

use App\Models\People\Employee;

class EmployeeService
{
    public function getEmployee() {
      try {
        $employee = Employee::with('position')->get();
        return $employee;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
    // Создание нового сотрудника
    public function createEmployee($data, $positionId = null)
    {
        try {
          $employee = new Employee();
          $employee->name = $data['name'];
          $employee->last_name = $data['last_name'];
          $employee->middle_name = $data['middle_name'];
          $employee->position_id = $positionId;

          $employee->save();

          return $employee;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //Получение сотрудника по ФИО
    public function getByFullName($data) {
      return Employee::where('name', $data['name'])
      ->where('last_name', $data['last_name'])
      ->where('middle_name', $data['middle_name'])
      ->first();
    }

    public function setPosition($id, $positionId) {
      $employee = Employee::where('id', $id)->first();
      $employee->position_id = $positionId;
      $employee->save();
      return $employee;
    }

    //получение по части фамилии для автоподстановки
    public function searchBySurname($data) {
      return Employee::where('last_name', 'LIKE', $data . '%')->with('position')->get();
    }
}
