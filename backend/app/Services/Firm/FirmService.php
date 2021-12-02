<?php


namespace App\Services\Firm;


use App\Models\Firm\Firm as FirmModel;

class FirmService
{

    public function createOrGetFirm($data)
    {
      try {
        $firm = FirmModel::where('title', '=', $data)->first();
        if(!$firm) {
            $firm = new FirmModel();
            $firm->title = $data;
            $firm->save();
        }
        return $firm;
      } catch (\Exception $exception) {
        throw new \Exception($exception->getMessage());
      }

    }
    // Создание фирмы
    public function createFirm($data)
    {
        try {
            $firm = new FirmModel();
            $firm->title = $data;
            $firm->save();
            return $firm;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получить список фирм
    public function getListFirms()
    {
        try {
            return FirmModel::all();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Редактирование фирмы
    public function updateFirm($data, $id)
    {
        try {
            $firm = new FirmModel();
            $firm->exists = true;
            $firm->id = $id;
            $firm->title = $data->title;
            $firm->save();
            return $firm;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Удаление фирмы
    public function deleteFirm($id)
    {
        try {
            $firm = new FirmModel();
            $firm->exists = true;
            $firm->id = $id;
            $firm->delete();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение фирмы по названию
    public function getFirmByTitle($firm){
        if(!$firm) return null;
        return FirmModel::where('title', $firm['title'])->first();
    }
}
