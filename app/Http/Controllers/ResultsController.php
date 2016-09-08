<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Challenger;
use App\FitibitToken;
use App\FitInfo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd(FitInfo::getSteps($request, '-'));
//        dd(FitInfo::getCalories($request, '-'));

        //$challenge = Challenge::find(2);
//        dd($challenge->challengers);
//        dd(FitInfo::getStat($request, '-', 'steps'));

        $challenges = Challenge::getFinishedChallenges();

        foreach ($challenges as $challenge) {
            $actualChallengers = $challenge->acceptedChallengers();

            if ($challenge->challengers->count() == $actualChallengers->count()) {
                $betType = $challenge->betType->name;
                $challengeType = $challenge->challengeType->name;

                foreach ($actualChallengers as $challenger) {
                    $challenger->score = FitInfo::getStat(
                        $challenger->user,
                        $challengeType
                    );
                    $challenger->save();
                }

                if ($betType == 'competitive') {
                    $winner = Challenger::competitive($actualChallengers);
                    foreach($actualChallengers as $index => $challenger) {
                        $updateChallenger = Challenger::find($challenger->id);
                        $updateUser = User::find($challenger->user_id);
                        if ($challenger->id == $winner->id) {
                            $updateChallenger->status = 'won';
                            $updateUser->coins += (count($actualChallengers) * $updateChallenger->challenge->wager);
                        } else {
                            $updateChallenger->status = 'lost';
                        }
                        $updateChallenger->save();
                        $updateUser->save();
                    }
                }

                if ($betType == 'personal') {
                    $updateChallenger = $actualChallengers[0];
                    $updateUser = User::find($updateChallenger->user_id);
                    if ($updateChallenger->score < $challenge->target) {
                        $updateChallenger->status = 'lost';
                    } else {
                        $updateChallenger->status = 'won';
                        $updateUser->coins += $challenge->wager;
                    }
                    $updateChallenger->save();
                    $updateUser->save();
                }

                if($betType == 'united') {

                    foreach($actualChallengers as $challenger) {
                        if ($challenger->score < $challenge->target) {
                            $pass = false;
                            break;
                        } else {
                            $pass = true;
                        }
                    }
                        if($pass) {
                            foreach ($actualChallengers as $challenger) {
                                $updateUser = User::find($challenger->user_id);
                                $challenger->status = 'won';
                                $updateUser->coins += $challenge->wager;
                                $updateUser->save();
                                $challenger->save();
                            }
                        } else {
                            foreach ($actualChallengers as $challenger) {
                                $challenger->status = 'lost';
                                $challenger->save();
                        }
                    }
                }

                 if($betType == 'shared') {
                    $wonChallengers = [];
                    $totalChallengers = count($actualChallengers);
                    foreach($actualChallengers as $challenger){
                        if($challenger->score < $challenge->target){
                            $challenger->status = 'lost';
                            $challenger->save();
                        } else {
                            array_push($wonChallengers, $challenger);
                            $challenger->status = 'won';
                            $challenger->save();
                        }
                    }
                    $wonCount = (count($wonChallengers));
                    foreach($wonChallengers as $challenger) {
                        $updateUser = User::find($challenger->user_id);
                        $updateUser->coins += (floor(($challenge->wager * $totalChallengers) / $wonCount));
                        $updateUser->save();
                    }  
                } 

//anyone who successfully completes the challenge will get their money back.
                if($betType == 'motivate') {
                    foreach($actualChallengers as $challenger) {
                        if($challenger->score > $challenge->target) {
                            $challenger->status = 'won';
                            $challenger->save();
                            $updateUser = User::find($challenger->user_id);
                            $updateUser->coins += $challenge->wager;
                            $updateUser->save();
                        } else {
                            $challenger->status = 'lost';
                            $challenger->save();
                        }
                    }
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Result::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
