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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function upcomingChallenges()
    {

    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }

    public function challengers($id)
    {
        $challenge = Challenge::find($id);
        return $this->challenge->challengers();
    }

    public static function findHistoric()
    {
        $result = results::join('challenges', 'challenges.id', '=', 'results.challenges_id')
            ->where('challenges.created_at', '<', DB::raw('CURDATE()'));
    }


    public static function competitive($challengers) {
        $max = $challengers[0]->score;
        $winner = $challengers[0];
        for($i = 0; $i < count($challengers); $i++){
            if($max < $challengers[$i]->score){
                $max = $challengers[$i]->score;
                $winner = $challengers[$i];
            }
        }
        return $winner;
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

            }while($challengers->count()[$activityType] < $wagerAmount);
    }

    public static function challengeWinners()
    {
        $challengeWinners = DB::table('challengers')
                ->select(DB::raw('count(status) as win_count'), 'users.name')
                ->join('users', 'challengers.user_id', '=', 'users.id')
                ->where('challengers.status', '=', 'won')
                ->orderBy('win_count', 'desc')
                ->groupBy('challengers.user_id')->take(8)->get();
        return $challengeWinners;
    }

    public static function coinsWonLeaders()
    {
        $coinsWon = DB::table('challengers')
                ->select(DB::raw('sum(winnings) as coins_won'), 'users.name')
                ->join('users', 'challengers.user_id', '=', 'users.id')
                ->orderBy('coins_won', 'desc')
                ->groupBy('challengers.user_id')->take(8)->get();
        return $coinsWon;
    }

}

