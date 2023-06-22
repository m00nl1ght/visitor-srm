<?php

namespace App\Http\Controllers\API\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNetworkName()
    {
        try {
            $networkName = DB::connection('sqlsrv')->table('Units')
                ->select('NetworkName')
                ->where('NetworkName', 'LIKE', 'N%')
                ->get();
            return response()->success($networkName);
        } catch (\Exception $exception) {
            return response()->error($exception);
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
            return response()->success($networkNameData);
        } catch (\Exception $exception) {
            return response()->error($exception);
        }

    }

}
