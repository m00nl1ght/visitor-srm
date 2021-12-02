<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\BaseController;
use App\Services\Settings\WorkingSecurityTeamSettingService;
use Illuminate\Http\Request;

class WorkingSecurityTeamSettingController extends BaseController
{
    private $workingSecurityTeamSettingService;

    public function __construct(WorkingSecurityTeamSettingService $workingSecurityTeamSettingService)
    {
        $this->workingSecurityTeamSettingService = $workingSecurityTeamSettingService;
    }

    // Получение списка настроек
    public function index()
    {
        try {
            $settings = $this->workingSecurityTeamSettingService->getListSettings();
            return $this->sendSuccess($settings, 'Список настроек получен успешно');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка получения списка настроек');
        }
    }

    // Создание настроек
    public function store(Request $request)
    {
        try {
            $setting = $this->workingSecurityTeamSettingService->createSetting($request);
            return $this->sendSuccess($setting, 'Настройки созданы успешно');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка создания настроек');
        }
    }

    // Получение настроек по id
    public function show($id)
    {
        try {
            $setting = $this->workingSecurityTeamSettingService->getSettingById($id);
            return $this->sendSuccess($setting, 'Настройки получены успешно');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка получения настроек');
        }
    }

    // Обновление настроек
    public function update(Request $request, $id)
    {
        try {
            $this->workingSecurityTeamSettingService->getSettingById($id);
            if($request->active){
                $setting = $this->workingSecurityTeamSettingService->updateActiveSetting($request, $id);
                return $this->sendSuccess($setting, 'Настройки изменены успешно');
            }
            $setting = $this->workingSecurityTeamSettingService->updateSetting($request, $id);
            return $this->sendSuccess($setting, 'Настройки изменены успешно');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка изменения настроек');
        }
    }

    // Удаление настроек
    public function destroy($id)
    {
        try {
            $activeSetting = $this->workingSecurityTeamSettingService->getActiveSetting();
            if($activeSetting && $activeSetting->id === +$id){
                return $this->sendSuccess(null, 'Невозможно удалить активные настройки');
            }
            $this->workingSecurityTeamSettingService->deleteSetting($id);
            return $this->sendSuccess(null, 'Настройки удалены успешно');
        } catch (\Exception $exception) {
            return $this->sendError($exception, 'Ошибка удаления настроек');
        }
    }


}
