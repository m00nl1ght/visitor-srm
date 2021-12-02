<?php

namespace App\Models\Income;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Visitor\Visitor;
use App\Models\People\Employee;
use App\Models\Security\Security;
use App\Models\Visitor\VisitorCategory;

class IncomeCar extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function security()
    {
        return $this->belongsTo(Security::class);
    }

    public function visitor_category()
    {
        return $this->belongsTo(VisitorCategory::class);
    }
}