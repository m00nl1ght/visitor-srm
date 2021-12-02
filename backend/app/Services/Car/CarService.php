<?php
namespace App\Services\Car;


use App\Models\Car\Car;
use Carbon\Carbon;

class CarService
{
  public function getOrCreate($data, $modelId) {
    try {
      $car = Car::where('reg_number', $data)->first();
      if(!$car) {
        $car = new Car();
        $car->reg_number = $data;
        $car->model_id = $modelId;
        $car->save();
      } 

      return $car;
    } catch (\Exception $exception){
        throw new \Exception($exception->getMessage());
    }
  }
}
