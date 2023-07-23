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
      return response($currentSecurityTeam);
    } catch (\Exception $exception) {
      return response($exception);
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
      return response($securityTeam);
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

      return response($workingSecurityTeam);
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
      $securitiesListId = $this->securityService->getListSecuritiesById($request->securities_id);
      $chiefSecurity = $this->securityService->getSecurityById($request->chief_id);
      $this->securityService->getSecurityById($request->operator_id);
      $this->roleSecurityService->checkIsRoleChiefSecurity($chiefSecurity);

      $this->securityTeamService->updatingSecuritiesListOfSecurityTeam($securitiesListId, $id);
      $securityTeam = $this->securityTeamService->updateSecurityTeam($request, $id);

      return response($securityTeam);
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
}
