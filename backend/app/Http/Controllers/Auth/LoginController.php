<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
  /**
   * @param LoginUserRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(LoginUserRequest $request)
  {

    if (Auth::attempt($request->validated())) {
      $roles = $request->user()->role;
      $rights = array();

      foreach ($roles as $role) {
        $rights[] = $role->slug;
      }

      $token = $request->user()->createToken('api', $rights);
      return response($token->plainTextToken);
    }

    return response()->json([], Response::HTTP_UNAUTHORIZED);
  }

  public function logout(Request $request)
  {
    // $user = Auth::user();

    // return response()->success('Отчет успешно полученdd', Auth::user());

    $request->user()->currentAccessToken()->delete();
    return response()->json([], Response::HTTP_OK);
  }
}
