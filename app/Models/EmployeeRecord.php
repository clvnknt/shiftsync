<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'profile_picture',
        'role_id',
        'department_id',
        'default_shift_id',
        'address_id',
    ];

    // Define your relationships here
    public function defaultShift()
    {
        return $this->belongsTo(Shift::class, 'default_shift_id');
    }
}
