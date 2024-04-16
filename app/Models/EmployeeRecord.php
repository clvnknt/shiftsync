<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'department_id', 
        'role_id', 
        'address_id', 
        'emergency_contact_id', 
        'shift_break_id', 
        'employee_first_name', 
        'employee_middle_name', 
        'employee_last_name', 
        'employee_suffix', 
        'employee_gender', 
        'employee_age', 
        'employee_birthdate', 
        'employee_profile_picture',
        'employee_timezone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function emergencyContact()
    {
        return $this->belongsTo(EmergencyContact::class);
    }

    public function shiftBreak()
    {
        return $this->belongsTo(ShiftBreak::class);
    }

    public function assignedShifts()
{
    return $this->hasMany(EmployeeAssignedShift::class);
}

public function employeeShiftRecords()
{
    return $this->hasMany(EmployeeShiftRecord::class);
}

}
