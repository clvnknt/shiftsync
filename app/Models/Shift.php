<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name',
        'shift_start_time',
        'shift_end_time',
        'lunch_start_time',
        'lunch_end_time',
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
