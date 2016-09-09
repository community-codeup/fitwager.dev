<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    protected $table = 'challenges';

    public static $rules = [];

    public function betType()
    {
        return $this->belongsTo(BetType::class, 'bet_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function challengeType()
    {
        return $this->belongsTo(ChallengeType::class, 'challenge_type');
    }

    public function challengers()
    {
        return $this->hasMany(Challenger::class);
    }

    public function acceptedChallengers()
    {
        return $this->challengers()->where('status', 'accepted')->get();
    }

    public static function subtractWager($challenge)
    {
        $challengers = $challenge->challengers;
        foreach ($challengers as $challenger) {
            if ($challenger->status !== 'accepted') {
                return false;
            }
        }
        foreach ($challengers as $challenger) {
            $updateUser = User::find($challenger->user_id);
            $updateUser->coins -= $challenge->wager;
            $updateUser->save();
        }
    }


    public static function getChallenges()
    {
        $challenges = DB::table('challenges')
            ->join('users', 'challenges.created_by', '=', 'users.id')
            ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
            ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
            ->join('challengers', 'challenges.id', '=', 'challengers.challenge_id');

        return $challenges;
    }


    public static function getActiveChallenges()
    {
        $challengers = DB::table('challengers')
            ->join('users', 'challengers.user_id', '=', 'users.id')
            ->join('challenges', 'challenges.id', '=', 'challengers.challenge_id')
            ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
            ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
            ->where('challengers.user_id', '=', Auth::id())
            ->where('challengers.status', '=', 'accepted')
            ->select(
                'challengers.status AS status',
                'challengers.challenge_id AS challenge_id',
                'bet_types.name AS bet_type',
                'challenge_types.name AS challenge_type',
                'challenges.wager AS wager',
                'users.name AS user_name',
                'challenges.created_by AS created_by_id'
            )
            ->get();

        foreach ($challengers as $challenger) {
            $challenge = Challenge::find($challenger->challenge_id);
            $challenger->created_by = $challenge->user->name;
            if ($challenge->acceptedChallengers()->count() == $challenge->challengers->count()) {
                $challenger->waitingOrLocked = 'locked in';
            } else {
                $challenger->waitingOrLocked = 'waiting for friends';
            }
        }
        return $challengers;
    }



public
static function getPendingChallenges()
{
    $challenges = static::getChallenges();
    $challenges = $challenges
        ->where('user_id', '=', Auth::id())
        ->where('challengers.status', '=', 'pending')
        ->select(
            'bet_types.name AS bet_type',
            'challenge_types.name AS challenge_type',
            'challengers.id',
            'challenges.wager',
            'users.name AS user_name',
            'challengers.status AS status',
            'challenges.start_date AS start_date',
            'challenges.end_date AS end_date'
        );
    return $challenges->get();
}

public
static function getFinishedChallenges()
{
    $challenges = Challenge::where('end_date', '<', DB::raw('CURDATE()'));
    return $challenges->get();
}

public
static function getHistoricChallenges()
{

    $challengers = DB::table('challengers')
        ->join('users', 'challengers.user_id', '=', 'users.id')
        ->join('challenges', 'challenges.id', '=', 'challengers.challenge_id')
        ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
        ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
        ->where('challengers.status', '=', 'won')
        ->orWhere('challengers.status', '=', 'lost')
        ->where('challengers.user_id', '=', Auth::id())
        ->select(
            'challengers.status AS status',
            'bet_types.name AS bet_type',
            'challenge_types.name AS challenge_type',
            'challenges.wager AS wager',
            'users.name AS user_name',
            'challenges.created_by AS created_by_id',
            'challengers.challenge_id AS challenge_id',
            'challengers.winnings AS winnings',
            'challenges.end_date AS end_date'
        )
        ->get();
    foreach($challengers as $challenger) {
        $challenge = Challenge::find($challenger->challenge_id);
        $challenger->created_by = $challenge->user->name;
    }
    return $challengers;

}


//public
//static function getChallengersArray()
//{
//    $challenges = Challenge::getFinishedChallenges();
//    $competitors = [];
//    foreach ($challenges as $index => $challenge) {
//        $competitors[] = Challenge::find($challenge->id)->challengers;
//    }
//    return $competitors;
//}

}

