<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAssignedCutoffPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'cutoff_period_id',
        'employee_record_id',
    ];

    // Define the relationship with the CutoffPeriod model
    public function cutoffPeriod()
    {
        return $this->belongsTo(CutoffPeriod::class);
    }

    // Define the relationship with the EmployeeRecord model
    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }
}
