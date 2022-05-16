<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignCase extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function caseList(){
        return $this->belongsTo(Caselist::class,'case_id','id');
    }

    public function doctorInfo(){
        return $this->hasOne(User::class,'id','doctor_id');
    }
    public function caseImg()
    {
        return $this->hasMany(caseImgs::class, 'case_id', 'id');
    }
    public function patientInfo(){
        return $this->hasOne(User::class,'id','patient_id');
    }
    public function descriptionInfo(){
        return $this->hasOne(prescription::class,'case_id','case_id');
    }
    public function paymentInfo(){
        return $this->hasOne(payment::class,'case_id','case_id');
    }
}
