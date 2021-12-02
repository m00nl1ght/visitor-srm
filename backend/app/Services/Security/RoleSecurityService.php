<?php


namespace App\Services\Security;


use App\Models\Security\RoleSecurity as RoleSecurityModel;

class RoleSecurityService
{
    // Создание роли для сотрудника охраны
    public function createRoleSecurity($data)
    {
        try {
            $roleSecurity = new RoleSecurityModel();
            $roleSecurity->title = $data->title;
            $roleSecurity->save();
            return $roleSecurity;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Обновление роли для сотрудника охраны
    public function updateRoleSecurity($data, $id)
    {
        try {
            $roleSecurity = new RoleSecurityModel();
            $roleSecurity->exists = true;
            $roleSecurity->id = $id;
            $roleSecurity->title = $data->title;
            $roleSecurity->save();
            return $roleSecurity;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Полуучение списка ролей для сотрудников охраны
    public function getListRolesSecurities()
    {
        try {
            return RoleSecurityModel::all();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение категории по id
    public function getRoleSecurityById($id){
        $roleSecurity = RoleSecurityModel::where('id', $id)->first();
        if($roleSecurity){
            return $roleSecurity;
        }
        throw new \Exception('С id: ' . $id . ' роли не найдено');
    }

    // Удаление роли сотрудника охраны
    public function deleteRoleSecurity($id)
    {
        $deletion = RoleSecurityModel::where('id', $id)->pluck('deletion')->first();

        if($deletion){
            try {
                $roleSecurity = new RoleSecurityModel();
                $roleSecurity->exists = true;
                $roleSecurity->id = $id;
                $roleSecurity->delete();
                return;
            } catch (\Exception $exception){
                throw new \Exception($exception->getMessage());
            }
        }
        throw new \Exception('Удаление записи с id ' . $id . ' запрещено');
    }

    public function checkIsRoleChiefSecurity($security)
    {
        if($security->role_security_id === 1) {
            return true;
        }
        throw new \Exception($security->last_name . ' ' . $security->name . ' ' . $security->middle_name . ' не является начальником смены');
    }
}
