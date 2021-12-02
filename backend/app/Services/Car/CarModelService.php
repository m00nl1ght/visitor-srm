<?php
namespace App\Services\Car;


use App\Models\Car\CarModel;
use Carbon\Carbon;

class CarModelService
{
    public function getOrCreate($data) {
      try {
        $car = CarModel::where('title', $data)->first();
        if(!$car) {
          $car = new CarModel();
          $car->title = $data;
          $car->save();
        } 

        return $car;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }
}
