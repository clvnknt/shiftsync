<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_first_name', 
        'contact_last_name', 
        'contact_relationship', 
        'contact_phone_number', 
        'contact_street', 
        'contact_city', 
        'contact_country', 
        'contact_postal_code'
    ];

    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }
}
