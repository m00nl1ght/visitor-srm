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
      return response($rolesSecurities);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Создание роли для сотрудника охраны
  public function store(Request $request)
  {
    try {
      $roleSecurity = $this->roleSecurityService->createRoleSecurity($request);
      return response($roleSecurity);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Получение роли сотрудник охраны по id
  public function show($id)
  {
    try {
      $roleSecurity = $this->roleSecurityService->getRoleSecurityById($id);
      return response($roleSecurity);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Обновление роли сотрудника охраны
  public function update(Request $request, $id)
  {
    try {
      $roleSecurity = $this->roleSecurityService->updateRoleSecurity($request, $id);
      return response($roleSecurity);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }


  // Удаление роли сотрудника охраны
  public function destroy($id)
  {
    try {
      $this->roleSecurityService->deleteRoleSecurity($id);
      return response(null);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
