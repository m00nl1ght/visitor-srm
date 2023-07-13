<?php

namespace App\Services\Roles;

use App\Models\Role;
// use Carbon\Carbon;

class RolesService
{
  public function getList()
  {
    try {
      $roles = Role::where('id', '!=', 1)->get();
      return $roles;
    } catch (\Exception $exception) {
      throw new \Exception($exception->getMessage());
    }
  }
}
