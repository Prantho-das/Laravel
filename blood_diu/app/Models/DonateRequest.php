<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonateRequest extends Model
{
    use HasFactory;
protected $guarded=[];

    public function relUser(){
        return $this->belongsTo(User::class,'user_id');
    }
}
