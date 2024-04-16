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
        'shift_order',
        'assigned_timezone'
    ];

    // Define the relationship to EmployeeAssignedShift
    public function employeeAssignedShift()
    {
        return $this->belongsTo(EmployeeAssignedShift::class);
    }

    public function assignedShift()
    {
        return $this->belongsTo(EmployeeAssignedShift::class, 'employee_assigned_shift_id');
    }

    public function employeeRecord()
    {
    return $this->belongsTo(EmployeeRecord::class, 'employee_record_id');
    }

}
