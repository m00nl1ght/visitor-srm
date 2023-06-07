<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Income\SystemAlarmListService;

class SystemAlarmListController extends Controller
{
  private $systemAlarmListService;

  public function __construct
  (
      SystemAlarmListService $systemAlarmListService
  )
  {
      $this->systemAlarmListService = $systemAlarmListService;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
          $systemAlarmList = $this->systemAlarmListService->getSystemAlarmList();
          return response()->success('Список получен успешно', $systemAlarmList);
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
        //
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
}
