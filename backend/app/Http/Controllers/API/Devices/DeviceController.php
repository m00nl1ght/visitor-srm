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
      return response($networkName);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  public function getNetworkNameData()
  {
    try {
      $networkNameData = $this->deviceService->getNetworkNameData();
      return response($networkNameData);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
