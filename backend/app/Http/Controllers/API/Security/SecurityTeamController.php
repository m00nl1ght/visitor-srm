<?php

namespace App\Http\Controllers\API\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Security\RoleSecurityService;
use App\Services\Security\SecurityService;
use App\Services\Security\SecurityTeamService;

class SecurityTeamController extends Controller
{
  private $securityTeamService;
  private $roleSecurityService;
  private $securityService;


  public function __construct(
    SecurityTeamService $securityTeamService,
    RoleSecurityService $roleSecurityService,
    SecurityService $securityService,
  ) {
    $this->securityTeamService = $securityTeamService;
    $this->roleSecurityService = $roleSecurityService;
    $this->securityService = $securityService;
    $this->middleware(['auth:sanctum']);
  }

  /**
   * Active security team
   *
   * @param  
   * @return \Illuminate\Http\Response
   */
  public function active()
  {
    try {
      $currentSecurityTeam = $this->securityTeamService->getActive();
      return response()->success('Активная рабочая смена охраны получена успешно', $currentSecurityTeam);
    } catch (\Exception $exception) {
      return response()->error('Ошибка получения активной рабочей смены охраны', $exception);
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    try {
      $securityTeam = $this->securityTeamService->getList($request->query('limit'));
      return response()->success('Список рабочих смен охраны успешно получен', $securityTeam);
    } catch (\Exception $exception) {
      return response()->error('Ошибка получения рабочих смен охраны', $exception);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
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
      $chiefSecurity = $this->securityService->getSecurityById($request->chief_id);
      $this->roleSecurityService->checkIsRoleChiefSecurity($chiefSecurity);
      $this->securityService->getSecurityById($request->operator_id);

      $securities = $this->securityService->getListSecuritiesById($request->securities_id);
      $workingSecurityTeam = $this->securityTeamService->createSecurityTeam($request, $securities);

      return response()->success('Рабочая смена охраны создана успешно', $workingSecurityTeam);
    } catch (\Exception $exception) {
      // return response()->error('Ошибка создания рабочей смены охраны', $exception);
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
      $securitiesListId = $this->securityService->getListSecuritiesById($request->securities_id);
      $chiefSecurity = $this->securityService->getSecurityById($request->chief_id);
      $this->securityService->getSecurityById($request->operator_id);
      $this->roleSecurityService->checkIsRoleChiefSecurity($chiefSecurity);

      $this->securityTeamService->updatingSecuritiesListOfSecurityTeam($securitiesListId, $id);
      $securityTeam = $this->securityTeamService->updateSecurityTeam($request, $id);

      return response()->success('Рабочая смена охраны обновлена успешно', $securityTeam);
    } catch (\Exception $exception) {
      // return response()->error('Ошибка обновления рабочей смены охраны', $exception);
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
}
