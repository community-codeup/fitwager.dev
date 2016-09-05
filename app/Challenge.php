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

    public function coins()
    {
    	return $this;
    }

    public static function historicResults($historic_query)
    {
    	$historicResults = [];
    	foreach($historic_query as $result){
    		$individualResult = $result->challenge_id;
    		$historicResults[] = $individualResult; 
    	}
    }
}

