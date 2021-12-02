<?php

namespace App\Models\Security;

use App\Models\WorkingSecurityTeam\WorkingSecurityTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    public $timestamps = false;
    use HasFactory;

    // Получение роли сотрудника охраны
    public function role()
    {
        return $this->belongsTo(RoleSecurity::class, 'role_security_id');
    }

    // Получение рабочих смен для сотрудника охранв
    public function workingSecurityTeam()
    {
        return $this->belongsToMany(WorkingSecurityTeam::class);
    }

}
