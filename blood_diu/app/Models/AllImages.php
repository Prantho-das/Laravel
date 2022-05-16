<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllImages extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function imageable()
    {
        return $this->morphTo('imageable');
    }
}
