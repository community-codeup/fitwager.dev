<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    protected $table = 'challenges';

    public static $rules = [];

    public function betType() {
        return $this->belongsTo(BetType::class, 'bet_type');
    }

    public function challengeType() {
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

    public static function subtractWager($challenge) {
        $challengers = $challenge->challengers;
        foreach($challengers as $challenger) {
            if ($challenger->status !== 'accepted') {
                return false;
            }
        }
        foreach($challengers as $challenger) {
            $updateUser = User::find($challenger->user_id);
            $updateUser->coins -= $challenge->wager;
            $updateUser->save();
        }
    }


    public static function getChallenges(){
        $challenges = DB::table('challenges')
            ->join('users', 'challenges.created_by', '=', 'users.id')
            ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
            ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
            ->join('challengers', 'challenges.id' ,'=', 'challengers.challenge_id');

        return $challenges;
    }

    public static function getActiveChallenges() {
        $challenges = static::getChallenges();
        $challenges = $challenges
            ->where('user_id', '=', Auth::id())
            ->where('challengers.status', '=', 'accepted')
            ->select(
                'bet_types.name AS bet_type',
                'challenge_types.name AS challenge_type',
                'challenges.id',
                'challenges.wager',
                'users.name AS user_name',
                'challengers.status AS status'
            );
        return $challenges->get();
    }

    public static function getPendingChallenges() {
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

    public static function getFinishedChallenges() {
        $challenges = Challenge::where('end_date', '<', DB::raw('CURDATE()'));
        return $challenges->get();
    }

    public static function getHistoricChallenges() {
        $challenges = static::getChallenges();
        $challenges = $challenges
            ->where('user_id', '=', Auth::id())
            ->where('challengers.status', '=', 'historic')
            ->select(
                'bet_types.name AS bet_type',
                'challenge_types.name AS challenge_type',
                'challenges.id',
                'challenges.wager',
                'users.name AS user_name',
                'challengers.status AS status'
            );
        return $challenges->get();
    }

    public static function getChallengersArray() {
        $challenges = Challenge::getFinishedChallenges();
        $competitors = [];
        foreach($challenges as $index => $challenge) {
            $competitors[] = Challenge::find($challenge->id)->challengers;
        }
        return $competitors;
    }

    public static function findHistoric()
    {
        $result = results::join('challenges', 'challenges.id', '=', 'results.challenges_id')
            ->where('challenges.created_at', '<', DB::raw('CURDATE()'));
    }
}

