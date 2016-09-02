<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    protected $table = 'challenges';
    public static $rules = [];


    public function challengers()
    {
    	return $this->hasMany(Challenger::class);
    }


}

