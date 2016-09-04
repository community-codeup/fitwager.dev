<?php

namespace App\Http\Controllers;

use App\BetType;
use App\Challenge;
use App\Challenger;
use App\ChallengeType;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = static::getChallenges();
        $data = [
            'challenges' => $challenges,
        ];
        return view('challenges.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $betTypes = BetType::all();
        $challengeTypes = ChallengeType::all();
        $users = User::all();
        $data = [
            'betTypes' => $betTypes,
            'challengeTypes' => $challengeTypes,
            'users' => $users,
        ];
        return view('challenges/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Log::info($request->all());
        $challenge = new Challenge;
        $challenge->description = $request['description'];
        $challenge->bet_type = $request['bet_type'];
        $challenge->challenge_type = $request['challenge_type'];
        $challenge->start_date = $request['start_date'];
        $challenge->end_date = $request['end_date'];
        $challenge->created_by = Auth::id();
        $challenge->wager = $request['wager'];
        $challenge->save();

        $challengers = $request['challengers'];
        foreach($challengers as $challenger_id) {
            $challenger = new Challenger;
            $challenger->user_id = $challenger_id;
            $challenger->challenge_id = $challenge->id;
            if($challenger_id == Auth::id()) {
                $challenger->status = 'accepted';
            }
            else {
                $challenger->status = 'pending';
            }
            $challenger->save();
        }

        return redirect()->action('ChallengesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public static function getChallenges(){
        $challenges = DB::table('challenges')
            ->join('users', 'challenges.created_by', '=', 'users.id')
            ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
            ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
            ->select('bet_types.name AS bet_name', 'challenge_types.name AS challenge_name', 'challenges.id', 'challenges.wager', 'users.name AS user_name')
            ->get();

        return $challenges;
    }

    public static function findHistoric()
    {
        $result = results::join('challenges', 'challenges.id', '=', 'results.challenges_id')
            ->where('challenges.created_at', '<', DB::raw('CURDATE()'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
