<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caselist extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function caseImg()
    {
        return $this->hasMany(caseImgs::class,'case_id','id');
    }

    public function paymentInfo(){
        return $this->hasOne(payment::class,'case_id','id');
    }
    public function prescription(){
        return $this->hasOne(prescription::class,'case_id','id');
    }

    public function patientInfo(){
        return $this->belongsTo(User::class,'patient_id');
    }

    public function assignCase()
    {
        return $this->hasOne(assignCase::class, 'case_id', 'id')
            ->leftJoin('users', 'users.id','=','assign_cases.doctor_id');
    }
    public function categoryInfo(){
        return $this->hasOne(doctorCategory::class,'id','category_id');
    }
}
