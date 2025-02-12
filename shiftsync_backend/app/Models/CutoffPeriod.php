<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutoffPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'start_date',
        'end_date',
        'cutoff_timezone',
    ];

    public function employeeAssignedCutoffPeriods()
    {
        return $this->hasMany(EmployeeAssignedCutoffPeriod::class);
    }
}