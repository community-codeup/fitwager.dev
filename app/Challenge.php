<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
            ->where('challengers.status', '=', 'active')
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
                'challengers.status AS status'
            );
        return $challenges->get();
    }

    public static function getFinishedChallenges() {
        $challenges = static::getChallenges();
        $challenges = $challenges
            ->where('challengers.status', '=', 'pending')
            ->select(
                'bet_types.name AS bet_type',
                'challenge_types.name AS challenge_type',
                'challenges.id AS challenge_id',
                'challenges.wager',
                'users.name AS user_name',
                'challengers.status AS status',
                'challengers.user_id AS challenger',
                'users.fitbit_id'
            );
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

    public static function findHistoric()
    {
        $result = results::join('challenges', 'challenges.id', '=', 'results.challenges_id')
            ->where('challenges.created_at', '<', DB::raw('CURDATE()'));
    }
}

