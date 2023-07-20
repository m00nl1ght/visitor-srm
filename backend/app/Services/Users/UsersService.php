<?php

namespace App\Services\Users;

use App\Models\User;
// use Carbon\Carbon;

class UsersService
{
  // public function getList()
  // {
  //   try {
  //     $users = User::where('id', '!=', 1)->get();
  //     return $users;
  //   } catch (\Exception $exception) {
  //     throw new \Exception($exception->getMessage());
  //   }
  // }
  public function getList()
  {
    try {
      $users = User::where('id', '!=', 1)->with(['role'])->get();
      return $users;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function getUserById($id)
  {
    try {
      $user = User::where('id', '=', $id)->with(['role'])->first();
      return $user;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function deleteUser($id)
  {
    try {
      if ($id == 1) {
        throw new \Exception('not delete admin');
      }

      $user = User::where('id', '=', $id)->first();

      if (!$user) {
        throw new \Exception('not found user');
      }

      $user->delete();
      return $user;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }

  public function addUserRoles($id, $roles)
  {
    try {
      if (in_array(1, $roles)) {
        throw new \Exception('not edit admin');
      }

      $user = User::where('id', '=', $id)->with('role')->first();
      $result = $user->role()->sync($roles);

      return $result;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
