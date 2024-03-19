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
        'end_shift_time',
        'break_frequency',
        'break_duration',
    ];

    // Define your relationships here
    public function employeeRecords()
    {
        return $this->hasMany(EmployeeRecord::class, 'default_shift_id');
    }

    public function employeeShiftRecords()
    {
        return $this->hasMany(EmployeeShiftRecord::class);
    }
}

