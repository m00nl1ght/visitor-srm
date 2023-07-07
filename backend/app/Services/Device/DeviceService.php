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
      $test = array("N1701161", "N1701161", "N1701614", "N1701144", "N1701637");
      $networkNameData = DB::connection('sqlsrv')->table('Units')
        ->leftJoin('Models', 'Units.ModelID', '=', 'Models.ModelID')
        ->select('Units.NetworkName', 'Units.InventoryNumber', 'Units.SerialNumber', 'Models.Name')
        ->whereIn('NetworkName', $test)
        ->get();

      return $networkNameData;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getDeviceDetails($networkNames)
  {
    try {
      // $listDevice = implode(',', $networkNames);

      $details = DB::connection('sqlsrv')->table('Units')
        ->leftJoin('Models', 'Units.ModelID', '=', 'Models.ModelID')
        ->select('Units.NetworkName', 'Units.InventoryNumber', 'Units.SerialNumber', 'Models.Name')
        ->whereIn('NetworkName', $networkNames)
        ->get();

      return $details;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
