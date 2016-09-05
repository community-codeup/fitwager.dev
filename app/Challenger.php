<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenger extends Model
{
    protected $table = 'challengers';
    public static $rules = [
    ];

    public static function challengeAccepted($challenge_id){
    	foreach($challengers as $challenger){
    		if($challenger->status == 'pending'){
    			//delay the challenge from starting
    		} else{
    			//allow the challenge to go off
    		}
    	}
    }

}

