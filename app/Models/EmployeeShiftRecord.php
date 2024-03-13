<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftRecord extends Model
{
    use HasFactory;

    // Define your fillable fields here
    protected $fillable = [
        'employee_id',
        'shift_id',
        'shift_date',
        'shift_started',
        'lunch_started',
        'lunch_ended',
        'shift_ended',
    ];

    // Define your relationships here
    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'employee_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    protected $casts = [
        'shift_started' => 'datetime',
        'lunch_started' => 'datetime',
        'lunch_ended' => 'datetime',
        'shift_ended' => 'datetime',
    ];

}
