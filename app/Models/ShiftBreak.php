<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'break_name', 
        'break_duration'
    ];

    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }
}
