<?php

namespace App\Http\Controllers\API\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\People\EmployeeService;

class EmployeeController extends Controller
{
  private $employeeService;

  public function __construct
  (
    EmployeeService $employeeService
  )
  {
      $this->employeeService = $employeeService;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $employee = $this->employeeService->getEmployee();
        return response()->success('Список открытых неисправностей получен', $employee);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
     * 
     */
    public function searchBySurname(Request $request) {
      try {
        $employeeList = $this->employeeService->searchBySurname($request->last_name);
        return response()->success('Список сотрудников получен', $employeeList);
      } catch (\Exception $exception) {
        return response()->error($exception);
      }
    }
}


