<?php

namespace App\Http\Controllers;

use App\BetType;
use App\Challenge;
use App\Challenger;
use App\ChallengeType;
use App\FitInfo;
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
        $data = [
            'activeChallenges' => Challenge::getActiveChallenges(),
            'historicChallenges' => Challenge::getHistoricChallenges(),
            'pendingChallenges' => Challenge::getPendingChallenges()
        ];
        return view('challenges.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $betTypes = BetType::all();
        $challengeTypes = ChallengeType::all();
        $friends = FitInfo::getFriends($request, '-');
//        dd($friends);
        $users = [];
        foreach($friends as $friend) {
            $user = User::where('fitbit_id', $friend[0]['user']['encodedId'])->first();
            if($user) {
                $users[] = $user;
            }
        };

//        $users = User::all();
        $data = [
            'betTypes' => $betTypes,
            'challengeTypes' => $challengeTypes,
            'users' => $users
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

    public function acceptChallenge($id) {
        $updateChallenger = Challenger::find($id);
        $updateChallenger->status = 'accepted';
        $updateChallenger->save();
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
