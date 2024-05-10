<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'condition',
        'overtime_rate',
    ];

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }
}
