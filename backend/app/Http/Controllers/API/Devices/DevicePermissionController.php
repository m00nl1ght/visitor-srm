<?php

namespace App\Http\Controllers\API\Devices;

use App\Http\Controllers\Controller;
use App\Services\Device\DevicePermissionService;
use App\Services\Device\DeviceService;
use Illuminate\Http\Request;

class DevicePermissionController extends Controller
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

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $list = $this->devicePermissionService->getList();
      return response($list);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $added = $this->devicePermissionService->addNew($request);
      return response($added);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
      $item = $this->devicePermissionService->updateOne($id, $request);
      return response($item);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param array $request->statuses
   * @return \Illuminate\Http\Response
   */
  public function getListByStatuses(Request $request)
  {
    try {
      $list = $this->devicePermissionService->getListByStatuses($request->statuses);

      $networkNames = array();
      for ($i = 0; $i < count($list); $i++) {
        array_push($networkNames, $list[$i]->device);
      }

      $listByDetails = $this->deviceService->getDeviceDetails($networkNames);
      // $listByDetails->toArray();
      //объединение данных
      foreach ($list as $value) {
        foreach ($listByDetails as $detail) {

          if ($value->device === $detail->NetworkName) {
            $value->details = $detail;
          }
        }
      }
      return response($list);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }

  /**
   * Change status of item.
   *
   * @param  int  $request->id
   * @param  string  $request->status
   * @return \Illuminate\Http\Response
   */
  public function changeStatus(Request $request)
  {
    try {
      $item = $this->devicePermissionService->changeStatus($request->id, $request->status);

      return response($item);
    } catch (\Exception $exception) {
      return response($exception);
    }
  }
}
