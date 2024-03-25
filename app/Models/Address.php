<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_street', 
        'employee_city', 
        'employee_country', 
        'employee_postal_code', 
        'type'
    ];

    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }
}
