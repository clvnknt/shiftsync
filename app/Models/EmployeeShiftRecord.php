<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'employee_assigned_shift_id',
        'shift_date',
        'start_shift',
        'start_lunch',
        'end_lunch',
        'end_shift',
    ];

    // Define the relationship to EmployeeAssignedShift
    public function employeeAssignedShift()
    {
        return $this->belongsTo(EmployeeAssignedShift::class);
    }
}
