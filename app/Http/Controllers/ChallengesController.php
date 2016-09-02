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
        return view('challenges.index');
    }

    public function test() {
        dd();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $user = User::find(1);
//        $user->token;
        $query = [
            'user_id' => '4TZJXN',
            'date' => '2016-09-02',
        ];

        $url = 'https://api.fitbit.com/1/user/4TZJXN/activities/date/2016-09-02.json';

        $ch = curl_init();
        $customHeader = [
            "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI0VFpKWE4iLCJhdWQiOiIyMjdTMlAiLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJyc29jIHJhY3QgcnNldCByd2VpIHJudXQgcnBybyByc2xlIiwiZXhwIjoxNDcyODU3MjUxLCJpYXQiOjE0NzI4Mjg0NTF9.wzbHdw1gj3bZrk6G_TSuMIGcr_wTdd1bQWvhZg5eu0E",
        ];
        $options = [
            CURLOPT_URL=> $url,
            CURLOPT_HTTPHEADER => $customHeader,
        ];

        curl_setopt_array($ch, $options);
        dd(curl_exec($ch));


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
//        $request->session()->flash('message', 'Did not store successfully.');
//        $this->validate($request, ChallengeType::$rules);
//        $request->session()->forget('message');

        dd( $_SESSION['fitbit']['oauth2'] );
        Log::info($request->all());
        $challenge = new Challenge;
        $challenge->description = $request['description'];
        $challenge->bet_type = $request['bet_type'];
        $challenge->challenge_type = $request['challenge_type'];
        $challenge->start_date = $request['start_date'];
        $challenge->end_date = $request['end_date'];
        $challenge->created_by = 1;
        $challenge->wager = $request['wager'];
        $challenge->save();


        $challengers = $request['challengers'];
        foreach($challengers as $challenger_info) {
            $challenger = new Challenger;
            $challenger->user_id = $challenger_info;
            $challenger->challenge_id = $challenge->id;
            $challenger->status = 'pending';
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
