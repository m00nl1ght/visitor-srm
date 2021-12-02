<?php

namespace App\Models\WorkingSecurityTeam;

use App\Models\Security\Security;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingSecurityTeam extends Model
{
    use HasFactory;

    // Связь с начальником группы охраны
    public function chief()
    {
        return $this->belongsTo(Security::class, 'chief_id');
    }

    // Связь с оператором группы охраны
    public function operator()
    {
        return $this->belongsTo(Security::class, 'operator_id');
    }

    // Связь с сотрудниками смены
    public function securities()
    {
        return $this->belongsToMany(Security::class);
    }

}
