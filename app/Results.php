<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Results extends Model
{

    protected $table = 'results';

	public static function challenges()
	{
		return $this->belongsTo(User::class, 'id');
	}

	public static function upcomingChallenges()
	{

	}

	public function challenge()
	{
		return $this->belongsTo(Challenge::class, 'challenge_id');
	}

	public function challengers()
	{
		$challenge = new Challenge::find($id);
		return $this->challenge->challengers();
	}

	public static function endChallenge($id) {
	    $results = fitInfo::resultsArray();

    }


	public static function competitive($challengers) {
		$max = $challengers[0];
		for($i=0; $ < count($challengers); $i++){
			if($max < $challengers[$i]){
				$max = $array[$i];
			}
		}
		return $max * count($challengers);
	}
    public static function competitive($challengers) {
        $max = $challengers[0];
        for($i=0; $ < count($challengers); i++){
            if($max < $challengers[$i]){
                $max = $array[$i]
            }
        }
        return $max * count($challengers);
    }
    public static function betTypePersonal($weneeduserfromchallenge, $challenge_id, $wagerAmount, $activityType){
        $person = challengers();
        if($person[$activityType][$result] >= $challenge[$challengeType][$challengetTypeAmount]){
            $userCoins += $wagerAmount;
        } else {
            $userCoins -= $wagerAmount;
        }
    }
    public static function betTypeUnited($challengers, $wagerAmount, $challenge_id, $challenge_goal_amount){
        foreach($challengers as $challenger => $activity)
            do{

            }while($challengers->count()[$activityType] <  )
    }
	// function betType competitive($request, $wager){
	// 	//foreach($challengers as $challenger => $result){
	// 		for($i = 0; $i < $challengers.length; i++){
	// 			if($challengers[$i]->$fitbit.property > $challengers[$i + 1] => $result){
	// 				$challenger[0]->user->coins += $wager ;

	// 			} elseif($challengers[0].result < $challengers[1].result){

	// 			}
	// 		//}
	// 	}	
	// }
	// if(challenge type = personal)
	// 	if(target_goal >= challengetype){
	// 		$coins + betAmount
	// 	} else{
	// 		$coins - betAmount
	// 	}
	// if(challenge type = united)
	// 	for($i = 0; $i < $challengers.length){
	// 		if($challengers[])
	// 	}

	// public static function showResults()
	// {
	// 	//Challenge or Challenges
	// 	$result = Challenge::orderBy('created_at');

	// 	if($result < CURDATE())
	// 	{
	// 		return Results::join('challenges', 'id', '=', 'challenge_id')
	// 		->where('created_by', '=', Auth::user()->id);
	// 	}
	// 	else
	// 	{
	// 		return Results::join('challenges', 'id', '=', 'challenge_id')
	// 		->where('created_by', '=', Auth::user()->id);
	// 	}
	// }

}
