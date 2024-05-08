<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tardiness extends Model
{
    use HasFactory;

    protected $table = 'tardiness';

    protected $fillable = [
        'employee_shift_record_id',
        'is_late_start_shift',
        'is_late_end_lunch',
        'hours_late_start_shift',
        'hours_late_end_lunch',
    ];

    public function employeeShiftRecord()
    {
        return $this->belongsTo(EmployeeShiftRecord::class, 'employee_shift_record_id');
    }
}