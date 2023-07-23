<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Users\UsersService;

class UserController extends Controller
{
  private $usersService;

  public function __construct(
    UsersService $usersService,
  ) {
    $this->usersService = $usersService;
  }


  /**
   * @param 
   * @return 
   */
  public function getCurrentUser()
  {
    $user = Auth::user();

    $roles = array();
    foreach ($user->role as $role) {
      $roles[] = $role->slug;
    }

    return response(array(
      "id" => $user->id,
      "name" => $user->name,
      "email" => $user->email,
      "roles" => $roles
    ));
  }

  /**
   * @param 
   * @return 
   * Get users list
   */
  public function index()
  {
    $list = $this->usersService->getList();
    return response($list);

    // $users = User::all();
    // return response()->success('Список пользователе получен', $users);
  }

  /**
   * Get user by id
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = $this->usersService->getUserById($id);
    return response($user);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = $this->usersService->deleteUser($id);
    return response($user);
  }


  public function addUserRoles(Request $request)
  {
    $result = $this->usersService->addUserRoles($request->query('id'), $request->roles);
    return response($result);
  }
}
