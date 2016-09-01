<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Results extends Model
{
    
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
		return $this->challenge->challengers();
	}

	public static function showResults()
	{
		//Challenge or Challenges
		$result = Challenge::orderBy('created_at');

		if($result < CURDATE())
		{
			return Results::join('challenges', 'id', '=', 'challenge_id')
			->where('created_by', '=', Auth::user()->id);
		}
		else
		{
			return Results::join('challenges', 'id', '=', 'challenge_id')
			->where('created_by', '=', Auth::user()->id);
		}
	}

}
