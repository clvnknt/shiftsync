<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $table = 'overtime';

    protected $fillable = [
        'employee_shift_record_id',
        'overtime_started',
        'overtime_ended',
        'overtime_hours',
    ];

    public function employeeShiftRecord()
    {
        return $this->belongsTo(EmployeeShiftRecord::class);
    }

    public function overtimeRule()
    {
        return $this->belongsTo(OvertimeRule::class);
    }
}
