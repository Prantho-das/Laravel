<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function senderInfo()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiverInfo()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function caseInfo()
    {
        return $this->belongsTo(Caselist::class, 'case_id');
    }
    public function assignInfo()
    {
        return $this->hasOne(assignCase::class, 'case_id', 'case_id');
    }
}


