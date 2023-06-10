<?php

namespace App\Http\Controllers\API\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        DB::connection('pgsql')->beginTransaction();
        $test = DB::connection('pgsql')->table('blog_entry')->get();
        DB::connection('pgsql')->commit();

        return response()->success('ТЕСТ БД', $test);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
    }
}
