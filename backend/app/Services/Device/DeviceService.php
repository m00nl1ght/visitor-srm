<?php

namespace App\Services\Device;

use Illuminate\Support\Facades\DB;

class DeviceService
{

  public function getNetworkName()
  {
    try {
      $networkName = DB::connection('sqlsrv')->table('Units')
        ->select('NetworkName')
        ->where('NetworkName', 'LIKE', 'N%')
        ->get();

      return $networkName;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getNetworkNameData()
  {
    try {
      $networkNameData = DB::connection('sqlsrv')->table('Units')
        ->leftJoin('Models', 'Units.ModelID', '=', 'Models.ModelID')
        ->select('Units.NetworkName', 'Units.InventoryNumber', 'Units.SerialNumber', 'Models.Name')
        ->where('NetworkName', 'LIKE', 'N%')
        ->get();

      return $networkNameData;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
