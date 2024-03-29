<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class RegistrationController
 * @package App\Http\Controllers\Auth
 */
class RegistrationController extends Controller
{
  /**
   * @param RegisterUserRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function registration(RegisterUserRequest $request)
  {
    try {
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);
      return response()->json(Response::HTTP_OK);
    } catch (\Exception $e) {
      return $this->sendError($e, 'Ошибка получения списка категорий');
      Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
      return response()->json([], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
