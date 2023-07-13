<?php

namespace App\Http\Controllers\API\Security;


use App\Http\Controllers\Controller;
use App\Services\Security\RoleSecurityService;
use Illuminate\Http\Request;

class RoleSecurityController extends Controller
{
    private $roleSecurityService;

    public function __construct(RoleSecurityService $roleSecurityService)
    {
        $this->roleSecurityService = $roleSecurityService;
    }

    // Получения списка ролей сотрудников охраны
    public function index()
    {
        try {
            $rolesSecurities = $this->roleSecurityService->getListRolesSecurities();
            return response()->success('Список ролей для сотрудников охраны успешно получе', $rolesSecurities);
        } catch (\Exception $exception) {
            return response()->error('Ошибка получение списока ролей для сотрудников охраны', $exception->getMessage());
        }
    }

    // Создание роли для сотрудника охраны
    public function store(Request $request)
    {
        try {
            $roleSecurity = $this->roleSecurityService->createRoleSecurity($request);
            return response()->success('Роль для сотрудника охраны успешно создана', $roleSecurity);
        } catch (\Exception $exception) {
            return response()->error('Ошибка создания роли для сотрудника охраны', $exception->getMessage());
        }
    }

    // Получение роли сотрудник охраны по id
    public function show($id)
    {
        try {
            $roleSecurity = $this->roleSecurityService->getRoleSecurityById($id);
            return response()->success('Роль для сотрудника охраны успешно получена', $roleSecurity);
        } catch (\Exception $exception) {
            return response()->error('Ошибка получения роли для сотрудника охраны', $exception->getMessage());
        }
    }

    // Обновление роли сотрудника охраны
    public function update(Request $request, $id)
    {
        try {
            $roleSecurity = $this->roleSecurityService->updateRoleSecurity($request, $id);
            return response()->success('Роль для сотрудника охраны успешно обновлена', $roleSecurity);
        } catch (\Exception $exception) {
            return response()->error('Ошибка обновления роли для сотрудника охраны', $exception->getMessage());
        }
    }


    // Удаление роли сотрудника охраны
    public function destroy($id)
    {
        try {
            $this->roleSecurityService->deleteRoleSecurity($id);
            return response()->success('Роль сотрудника охраны удалена успешно', null);
        } catch (\Exception $exception) {
            return response()->error('Ошибка удаления роли сотрудника охраны', $exception->getMessage());
        }
    }


}
