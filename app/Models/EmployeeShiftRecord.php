<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShiftRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_record_id',
        'shift_date',
        'start_shift',
        'start_lunch',
        'end_lunch',
        'end_shift',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}