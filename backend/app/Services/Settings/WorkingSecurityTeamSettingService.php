<?php


namespace App\Services\Settings;


use App\Models\Settings\WorkingSecurityTeamSetting as SettingModel;

class WorkingSecurityTeamSettingService
{

    // Создание настроек для смены охраны
    public function createSetting($data)
    {

        try {
            $setting = new SettingModel();
            $setting->time_start = $data->timeStart;
            $setting->duration = $data->duration;
            $setting->save();
            return $setting;
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение списка настроек для смены
    public function getListSettings()
    {
        try {
            return SettingModel::all();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение активной смены
    public function getActiveSetting()
    {
        try {
            return SettingModel::where('active', true)->first();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Обновление настроек смены
    public function updateSetting($data, $id)
    {
        try {
            $setting = new SettingModel();
            $setting->exists = true;
            $setting->id = $id;
            $setting->time_start = $data->timeStart;
            $setting->duration = $data->duration;
            $setting->save();
            return SettingModel::all();

        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Обновление активных настроек
    public function updateActiveSetting($data, $id)
    {
        try {
            $settings = SettingModel::all();
            foreach ($settings as $setting) {
                $updateSetting = new SettingModel();
                $updateSetting->exists = true;
                $updateSetting->id = $setting->id;
                $updateSetting->active = false;
                if($setting->id === +$id){
                    $updateSetting->active = true;
                    $updateSetting->time_start = $data->timeStart;
                    $updateSetting->duration = $data->duration;
                }
                $updateSetting->update();
            }
            return SettingModel::all();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Удаление настроек
    public function deleteSetting($id)
    {
        try {
            $setting = new SettingModel();
            $setting->exists = true;
            $setting->id = $id;
            $setting->delete();
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    // Получение настроек по id
    public function getSettingById($id)
    {
        $setting = SettingModel::where('id', $id)->first();
        if($setting){
            return $setting;
        }
        throw new \Exception('настройки с id' . $id . ' не найдены');
    }


}
