<?php


namespace App\Services\Visitor;


use App\Models\Visitor\VisitorCategory;
use App\Models\Visitor\Visitor as VisitorModel;

class VisitorService
{
    public function createVisitor($data, $params)
    {
        try {
            $visitor = new VisitorModel();
            $visitor->name = $data['name'];
            $visitor->last_name = $data['last_name'];
            $visitor->middle_name = $data['middle_name'];
            $visitor->phone = $data['phone'];
            if(isset($params['firm_id'])) $visitor->firm_id = $params['firm_id'];
            if(isset($params['car_id'])) $visitor->car_id = $params['car_id'];
            $visitor->save();
            return $visitor;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateVisitor($visitor, $data, $params)
    {
      try {
        $visitor->phone = $data['phone'];
        if(isset($params['firm_id'])) $visitor->firm_id = $params['firm_id'];
        if(isset($params['car_id'])) $visitor->car_id = $params['car_id'];

        $visitor->update();
        return $visitor;
      } catch (\Exception $exception){
          throw new \Exception($exception->getMessage());
      }
    }

    public function updateVisitorFirm($visitorId, $firmId)
    {
        try {
            $visitor = new VisitorModel();
            $visitor->exists = true;
            $visitor->id = $visitorId;
            $visitor->firm_id = $firmId;
            $visitor->save();
            return $visitor;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение поситителя по ФИО
    public function getVisitorByFullName($data)
    {
        return VisitorModel::where('name', $data['name'])
            ->where('last_name', $data['last_name'])
            ->where('middle_name', $data['middle_name'])
            ->first();
    }

    public function getById($id)
    {
        return VisitorModel::where('id', $id)->first();
    }

    public function searchBySurname($data) {
      return VisitorModel::where('last_name', 'LIKE', $data . '%')
        ->with(['car', 'car.car_model', 'firm', 'position'])
        ->get();
    }

   /* public function updateVisitorFirm($firmId)
    {
        $visitor = new Visitor();
        $visitor->exists = true;
    }*/
}
