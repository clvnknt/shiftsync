<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name',
        'start_shift_time',
        'shift_start_grace_period',
        'lunch_start_time',
        'end_lunch_time',
        'end_shift_time',
        'shift_utc_offset',
    ];

     // Define the reverse relationship to EmployeeAssignedShift
     public function employeeAssignedShifts()
     {
         return $this->hasMany(EmployeeAssignedShift::class);
     }
}
