<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function assign_info()
    {
        return $this->hasOne(assignCase::class, 'case_id', 'case_id')
            ->join(
                'users',
                'users.id',
                'assign_cases.doctor_id',
            )
            ->join(
                'specilization_of_doctors',
                'specilization_of_doctors.doctor_id',
                'assign_cases.doctor_id',
            )
            ;
    }
}
