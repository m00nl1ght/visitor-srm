<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
  /**
   * @param 
   * @return 
   */
  public function getCurrentUser(Request $request)
  {
    // $user = Auth::user()->fresh('role');
    $user = Auth::user();
    
    $roles = array();
    foreach ($user->role as $role) {
      $roles[] = $role->slug;
    }

    // "security_chief","security"
    return response()->success('Текущий пользователь получен', array(
      "id" => $user->id,
      "name" => $user->name,
      "email" => $user->email,
      "roles" => $roles
    ));
  }

  /**
   * @param 
   * @return 
   */
  public function getUserList(Request $request)
  {
    $users = User::all();
    return response()->success('Список пользователе получен', $users);
  }
}
