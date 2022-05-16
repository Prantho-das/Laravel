<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // doctor status
    public function doctorStatus()
    {
        return $this->hasOne(doctorStatus::class, 'doctor_id', 'id');
    }
    public function doctorCase()
    {
        return $this->hasMany(assignCase::class, 'doctor_id', 'id');
    }
    public function doctorCasePatient()
    {
        return $this->hasMany(assignCase::class, 'doctor_id', 'id')
            ->leftJoin('users', 'assign_cases.doctor_id', '=', 'users.id');
    }
    public function specialization()
    {
        return $this->hasOne(specilization_of_doctor::class, 'doctor_id','id');
    }
    public function user_case_assign()
    {
        return $this->hasOneThrough(Caselist::class, assignCase::class, 'patient_id', 'patient_id', 'id');
    }

    public function userlog()
    {
        return $this->hasOne(Loginfo::class,'user_id','id');
    }
    public function patientCaseNumber()
    {
        return $this->hasMany(Caselist::class, 'patient_id');
    }
}
