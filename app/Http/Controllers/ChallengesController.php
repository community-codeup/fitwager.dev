<?php

namespace App\Http\Controllers;

use App\BetType;
use App\Challenge;
use App\Challenger;
use App\ChallengeType;
use App\FitInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'activeChallenges' => Challenge::getActiveChallenges(),
            'historicChallenges' => Challenge::getHistoricChallenges(),
            'pendingChallenges' => Challenge::getPendingChallenges(),
            'showPending' => $request->has('status'),
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
        $challengeTypes[1]->name = 'calories';

        $friends = FitInfo::getFriends(Auth::user())['friends'];
        $users = [];
        foreach ($friends as $index => $friend) {
            $user = User::where('fitbit_id', $friend['user']['encodedId'])->first();
            if ($user) {
                $users[] = $user;
            }
        }

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
     * @param  \Illuminate\Http\Request $request
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
        $challenge->target = $request['targetScore'];
        $challenge->save();

        $challengers = $request['challengers'];
        foreach ($challengers as $challenger_id) {
            $challenger = new Challenger;
            $challenger->user_id = $challenger_id;
            $challenger->challenge_id = $challenge->id;
            if ($challenger_id == Auth::id()) {
                $challenger->status = 'accepted';
            } else {
                $challenger->status = 'pending';
            }
            $challenger->save();
        }

        Challenge::subtractWager($challenge);

        return redirect()->action('ChallengesController@index');
    }

    public function acceptChallenge($id)
    {
        $updateChallenger = Challenger::find($id);
        $updateChallenger->status = 'accepted';
        $updateChallenger->save();

        Challenge::subtractWager($updateChallenger->challenge);
        return redirect()->action('ChallengesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $betTypes = BetType::all();
        $challengeTypes = ChallengeType::all();
        $challengeTypes[1]->name = 'calories';
        $challenge = Challenge::find($id);
        $friends = FitInfo::getFriends(Auth::user())['friends'];
        $users = [];
        foreach ($friends as $index => $friend) {
            $user = User::where('fitbit_id', $friend['user']['encodedId'])->first();
            if ($user) {
                $users[] = $user;
            }
        }

        $data = [
            'betTypes' => $betTypes,
            'challengeTypes' => $challengeTypes,
            'users' => $users,
            'challenge' => $challenge
        ];
        return view('challenges.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $challenge = Challenge::find($id);
        $originalChallengers = $challenge->challengers;
        foreach($originalChallengers as $challenger) {
            $originalChallenger = Challenger::find($challenger->id);
            $originalChallenger->delete();
        }
        $challenge->bet_type = $request['bet_type'];
        $challenge->challenge_type = $request['challenge_type'];
        $challenge->start_date = $request['start_date'];
        $challenge->end_date = $request['end_date'];
        $challenge->wager = $request['wager'];
        $challenge->target = $request['targetScore'];

        $newChallengers = $request['challengers'];
        foreach ($newChallengers as $challenger_id) {
            $challenger = new Challenger;
            $challenger->user_id = $challenger_id;
            $challenger->challenge_id = $challenge->id;
            if ($challenger_id == Auth::id()) {
                $challenger->status = 'accepted';
            } else {
                $challenger->status = 'pending';
            }
            $challenger->save();
        }

        $challenge->save();
        return redirect()->action('ChallengesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
        public function destroy(Request $request)
    {
        $request->session()->flash('message', 'Did not destroy successfully.');
        $challengeId = $request['deleteChallengeField'];
        $challenge = Challenge::find($challengeId);
        if (!$challenge) {
            abort(404);
        }
        $challengers = $challenge->challengers;
        foreach($challengers as $challenger) {
            $challenger->delete();
        }


        $request->session()->forget('message');
        $challenge->delete();

        return redirect()->action('ChallengesController@index');
    }

    public function result($id)
    {
        $challenge = Challenge::find($id);
        $winners = Challenger::where('status', 'won')->where('challenge_id', $id)->get();
        $losers = Challenger::where('status', 'lost')->where('challenge_id', $id)->get();

        $categories = [];
        $dataAmount = [];
        $challengers = $challenge->challengers;
        foreach($challengers as $challenger) {
            array_push($categories, $challenger->user->name);
            array_push($dataAmount, (float) $challenger->score);
        }

        $graphInfo = ['categories' => $categories, 'amount' => $dataAmount];

        $data = [
            'challenge' => $challenge,
            'winners' => $winners,
            'losers' => $losers,
            'graphInfo' => $graphInfo
        ];

        return view('challenges.result', $data);
    }

}
