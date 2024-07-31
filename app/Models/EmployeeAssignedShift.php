<?php

// app/Models/EmployeeAssignedShift.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAssignedShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'shift_schedule_id',
        'is_active',
    ];

    // Define the relationship to ShiftSchedule
    public function shiftSchedule()
    {
        return $this->belongsTo(ShiftSchedule::class);
    }

    // Define the reverse relationship to EmployeeShiftRecord
    public function employeeShiftRecords()
    {
        return $this->hasMany(EmployeeShiftRecord::class);
    }

    // Define the relationship to EmployeeRecord
    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }
}
