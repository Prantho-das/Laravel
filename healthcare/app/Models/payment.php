<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function case()
    {
        return $this->belongsTo(Caselist::class);
    }

    public function caseCategoryPatientInfo()
    {
        return $this->hasOne(Caselist::class,'id','case_id')
        ->join('doctor_categories', 'doctor_categories.id', 'caselists.category_id');
    }
    // public function caseAssign()
    // {
    //     return $this->hasOne(Caselist::class,'id','case_id')->join('doctor_categories', 'doctor_categories.id', 'caselists.id')->select("caselists.*", "doctor_categories.category_name")->latest();

    // }
    public function caseAssign()
    {
        return $this->hasOne(Caselist::class, 'id', 'case_id')
        ->join('doctor_categories', 'doctor_categories.id', 'caselists.category_id')
        ->select("caselists.*", "doctor_categories.category_name")
        ->latest();
    }
}
