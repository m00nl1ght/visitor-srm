<?php

namespace App\Http\Controllers\API\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Device\DeviceService;

use App\Services\Device\DevicePermissionService;

class DevicePermissionController extends Controller
{
  private $devicePermissionService;

  public function __construct(
    DevicePermissionService $devicePermissionService
  ) {
    $this->devicePermissionService = $devicePermissionService;
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
      return response()->success('Device list received', $list);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
      return response()->success('Добавлено успешно', $added);
    } catch (\Exception $exception) {
      return response()->error($exception);
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
    //
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
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function getListByStatuses(Request $request)
  {
    try {
      $list = $this->devicePermissionService->getListByStatuses($request->statuses);
      return response()->success('Device list received', $list);
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
