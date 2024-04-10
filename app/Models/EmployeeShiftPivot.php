<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeShiftPivot extends Model
{
    protected $table = 'employee_shift_pivot';

    protected $fillable = [
        'employee_record_id',
        'shift_id',
        'is_active',
    ];
    
    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
