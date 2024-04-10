<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name', 
        'start_shift_time', 
        'shift_start_grace_period', 
        'lunch_start_time', 
        'end_lunch_time', 
        'end_shift_time'
    ];

    public function employeeRecords()
    {
        return $this->belongsToMany(EmployeeRecord::class, 'employee_shift_pivot')
                    ->using(EmployeeShiftPivot::class)
                    ->withPivot('is_active');
    }
}

