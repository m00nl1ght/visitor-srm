<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\People\Employee;
use App\Models\Card\Card;

class IncomeFoggotenCard extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function boss_employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
