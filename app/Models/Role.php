<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'role_name',
        'role_description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employeeRecords()
    {
        return $this->hasMany(EmployeeRecord::class);
    }
}
