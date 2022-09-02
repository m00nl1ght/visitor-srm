<?php

namespace App\Http\Controllers\API\WorkingSecurityTeam;

use App\Http\Controllers\BaseController;
use App\Services\Security\RoleSecurityService;
use App\Services\Security\SecurityService;
use App\Services\Settings\WorkingSecurityTeamSettingService;
use App\Services\WorkingSecurityTeam\WorkingSecurityTeamService;
use Illuminate\Http\Request;

class WorkingSecurityTeamController extends BaseController
{
    private $workingSecurityTeamService;
    private $roleSecurityService;
    private $securityService;
    private $workingSecurityTeamSettingService;

    public function __construct
    (
        WorkingSecurityTeamService $workingSecurityTeamService,
        RoleSecurityService $roleSecurityService,
        SecurityService $securityService,
        WorkingSecurityTeamSettingService $workingSecurityTeamSettingService
    )
    {
        $this->workingSecurityTeamService = $workingSecurityTeamService;
        $this->roleSecurityService = $roleSecurityService;
        $this->securityService = $securityService;
        $this->workingSecurityTeamSettingService = $workingSecurityTeamSettingService;
        $this->middleware(['auth:sanctum']);
    }

    // Получения списка рабочих смен охраны
    public function index()
    {
        try {
            $workingSecurityTeams = $this->workingSecurityTeamService->getListWorkingSecurityTeams();
            return response()->success('Список рабочих смен охраны успешно получен', $workingSecurityTeams);
        } catch (\Exception $exception) {
            return response()->error('Ошибка получения рабочих смен охраны', $exception);
        }
    }

    // Создание рабочей смены охраны
    public function store(Request $request)
    {
        try {
            $chiefSecurity = $this->securityService->getSecurityById($request->chief_id);
            $this->roleSecurityService->checkIsRoleChiefSecurity($chiefSecurity);
            $this->securityService->getSecurityById($request->operator_id);
            $securities = $this->securityService->getListSecuritiesById($request->securities_id);

            $workingSecurityTeam = $this->workingSecurityTeamService->createWorkingSecurityTeam($request, $securities);

            return response()->success('Рабочая смена охраны создана успешно', $workingSecurityTeam);
        } catch (\Exception $exception) {
            // return response()->error('Ошибка создания рабочей смены охраны', $exception);
            return response($exception);
        }
    }

    // Получение рабочей смены охраны по id
    public function show($id)
    {
        try {
            $workingSecurityTeam = $this->workingSecurityTeamService->getWorkingSecurityTeamById($id);
            return response()->success('Рабочая смена охраны получена успешно', $workingSecurityTeam);
        } catch (\Exception $exception) {
            return response()->error('Ошибка получения рабочей смены охраны', $exception);
        }
    }

    // Обновление рабочей смены охраны
    public function update(Request $request, $id)
    {
        try {
            $securitiesListId = $this->securityService->getListSecuritiesById($request->securities_id);
            $chiefSecurity = $this->securityService->getSecurityById($request->chief_id);
            $this->securityService->getSecurityById($request->operator_id);
            $this->roleSecurityService->checkIsRoleChiefSecurity($chiefSecurity);

            $this->workingSecurityTeamService->updatingSecuritiesListOfWorkingSecurityTeam($securitiesListId, $id);
            $workingSecurityTeam = $this->workingSecurityTeamService->updateWorkingSecurityTeam($request, $id);

            return response()->success('Рабочая смена охраны обновлена успешно', $workingSecurityTeam);
        }catch (\Exception $exception) {
            // return response()->error('Ошибка обновления рабочей смены охраны', $exception);
            return response($exception);
        }
    }

    // Получение активной рабочей смены охраны
    public function active()
    {
        try {
            $setting = $this->workingSecurityTeamSettingService->getActiveSetting();
            $currentWorkingSecurityTeam = $this->workingSecurityTeamService->getCurrentSecurityTeam($setting);
            if($currentWorkingSecurityTeam){
                return response()->success('Активная рабочая смена охраны получена успешно', $currentWorkingSecurityTeam);
            }
            return response()->success('Активная рабочая смена отсутствует', null);
        } catch (\Exception $exception) {
            return response()->error('Ошибка получения активной рабочей смены охраны', $exception);
        }
    }

    public function last() {
      try {
        $team = $this->workingSecurityTeamService->getLastWorkingSecurityTeam();
        return response()->success('Последняя активная смена получена', $team);
      } catch (\Exception $exception) {
          return response()->error('Ошибка получения активной рабочей смены охраны', $exception);
      }
      
    }

    // Удаление рабочей смены охраны
    public function destroy($id)
    {
        try {
            $this->workingSecurityTeamService->deleteWorkingSecurityTeam($id);
            return response()->success('Смена охраны удалена успешно', null);
        } catch (\Exception $exception) {
            return response()->error('Ошибка удаления смены охраны', $exception);
        }
    }

}
