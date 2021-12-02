<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Income\SystemAlarmList;

class IncomeAlarm extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    public function system_alarm_list()
    {
        return $this->belongsTo(SystemAlarmList::class);
    }
}
