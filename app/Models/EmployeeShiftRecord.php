<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'employee_shift_pivot_id',
        'shift_date',
        'start_shift',
        'start_lunch',
        'end_lunch',
        'end_shift',
    ];

    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class, 'employee_record_id');
    }

    public function employeeShiftPivot()
    {
        return $this->belongsTo(EmployeeShiftPivot::class, 'employee_shift_pivot_id');
    }
}

