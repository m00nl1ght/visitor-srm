<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car\CarModel;

class Car extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function car_model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
