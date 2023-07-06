<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\Device\DeviceService;
use App\Services\Device\DevicePermissionService;

class WelcomeController extends Controller
{
  private $devicePermissionService;
  private $deviceService;

  public function __construct(
    DeviceService $deviceService,
    DevicePermissionService $devicePermissionService
  ) {
    $this->devicePermissionService = $devicePermissionService;
    $this->deviceService = $deviceService;
  }

  public function index()
  {
    $list = $this->devicePermissionService->getListByStatuses(array('new'));

    $networkNames  = array();
    for ($i = 0; $i < count($list); $i++) {
      array_push($networkNames, $list[$i]->device);
    }
    
    // $listByDetails = $this->deviceService->getDeviceDetails($networkNames);
    dd($list);

    return view('welcome', ['data' => $list]);
  }
}
