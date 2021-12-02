<?php


namespace App\Services\Security;


use App\Models\Security\Security as SecurityModel;
use App\Models\Security\RoleSecurity;

class SecurityService
{

    private function getAllCollections($security)
    {
        try {
            return $security
                ->load('role');
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Добавление сотрудника охраны
    public function createSecurity($data)
    {
        try {
            $security = new SecurityModel();
            $security->role_security_id = $data->role_security_id;
            $security->name = $data->name;
            $security->last_name = $data->last_name;
            $security->middle_name = $data->middle_name;
            $security->save();
            return $this->getAllCollections($security);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение списка сотрудников охраны
    public function getListSecurities()
    {
        try {
            $securities = SecurityModel::all();
            return $this->getAllCollections($securities);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Обновление информации о сотруднике охраны
    public  function updateSecurity($data, $id)
    {
        try {
            $security = new SecurityModel();
            $security->exists = true;
            $security->id = $id;
            $security->role_security_id = $data->role_security_id;
            $security->name = $data->name;
            $security->last_name = $data->last_name;
            $security->middle_name = $data->middle_name;
            $security->save();
            return $this->getAllCollections($security);
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Удаление сотрудника охраны
    public function deleteSecurity($id)
    {
        try {
            $security = new SecurityModel();
            $security->exists = true;
            $security->id = $id;
            $security->delete();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение сотруднико охраны по id
    public function getSecurityById($id)
    {
        $security = SecurityModel::where('id', $id)->first();
        if($security){

            return $this->getAllCollections($security);
        }
        throw new \Exception('С id: ' . $id . ' сотрудника охраны не найдено');
    }

    // Получение списка сотрудников охраны по переданным id
    public function getListSecuritiesById($securitiesId)
    {
        try {
            $securities = SecurityModel::find($securitiesId);
          
            return $this->getAllCollections($securities);

        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
