<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $table = 'overtime';

    use HasFactory;

    protected $fillable = [
        'employee_shift_record_id',
        'is_overtime',
        'overtime_hours',
    ];

    public function employeeShiftRecord()
    {
        return $this->belongsTo(EmployeeShiftRecord::class, 'employee_shift_record_id');
    }
}