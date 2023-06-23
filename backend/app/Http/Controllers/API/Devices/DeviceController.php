<?php

namespace App\Http\Controllers\API\Devices;

use App\Http\Controllers\Controller;

use App\Services\Device\DeviceService;

class DeviceController extends Controller
{
  private $deviceService;

  public function __construct(
    DeviceService $deviceService,
  ) {
    $this->deviceService = $deviceService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getNetworkName()
  {
    try {
      $networkName = $this->deviceService->getNetworkName();
      return response()->success('Device list received', $networkName);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }

  public function getNetworkNameData()
  {
    try {
      $networkNameData = $this->deviceService->getNetworkNameData();
      return response()->success('Device list received', $networkNameData);
    } catch (\Exception $exception) {
      return response()->error($exception);
    }
  }
}
