<?php

namespace App\Http\Controllers\API\Security;


use App\Http\Controllers\Controller;
use App\Services\Security\RoleSecurityService;
use App\Services\Security\SecurityService;
use Illuminate\Http\Request;


class SecurityController extends Controller
{
  private $securityService;
  private $roleSecurityService;

  public function __construct(
    RoleSecurityService $roleSecurityService,
    SecurityService $securityService
  ) {
    $this->roleSecurityService = $roleSecurityService;
    $this->securityService = $securityService;
  }

  // Получение списка сотрудников охраны
  public function index()
  {
    try {
      $securities = $this->securityService->getListSecurities();
      return response($securities);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Добавление сотрудника охраны
  public function store(Request $request)
  {
    try {
      $this->roleSecurityService->getRoleSecurityById($request->role_security_id);
      $security = $this->securityService->createSecurity($request);
      return response($security);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Получение сотрудника охраны по id
  public function show($id)
  {
    try {
      $security = $this->securityService->getSecurityById($id);
      return response($security);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Обновление информации о сотруднике охраны
  public function update(Request $request, $id)
  {
    try {
      $this->roleSecurityService->getRoleSecurityById($request->role_security_id);
      $security = $this->securityService->updateSecurity($request, $id);
      return response($security);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  // Удаление сотрудника охраны
  public function destroy($id)
  {
    try {
      $this->securityService->deleteSecurity($id);
      return response(null);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
