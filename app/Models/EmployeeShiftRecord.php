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
        'start_shift',
        'start_lunch',
        'end_lunch',
        'end_shift',
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
        'start_lunch' => 'datetime',
        'end_lunch' => 'datetime',
        'end_shift' => 'datetime',
    ];
}
