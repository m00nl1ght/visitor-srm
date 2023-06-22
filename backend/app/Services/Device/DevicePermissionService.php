<?php

namespace App\Services\Device;

use App\Models\Device\DevicePermission as DevicePermissionModel;

class DevicePermissionService
{

  public function getList()
  {
    try {
      $list = DevicePermissionModel::all();
      return $list;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function addNew($data)
  {
    try {
      $item = new DevicePermissionModel;
      $item->employee_id = $data->employee_id;
      $item->device = $data->device;
      $item->status = "new";

      $item->save();
      return $item;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getListByStatuses($statuses)
  {
    try {
      $list = DevicePermissionModel::whereIn('status', $statuses)
        ->with(['employee'])
        ->get();;
      return $list;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
