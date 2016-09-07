<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\FitibitToken;
use App\FitInfo;
use Illuminate\Http\Request;
use App\Results;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jmitchell38488\OAuth2\Client\Provider\FitBit;

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
//            dd($challenge->challengers);
            $actualChallengers = $challenge->acceptedChallengers();

            if ($challenge->challengers->count() == $actualChallengers->count()) {
                $betType = $challenge->betType->name;
                $challengeType = $challenge->challengeType->name;

                foreach ($actualChallengers as $challenger) {
                    $challenger->amount = FitInfo::getStat(
                        $request,
                        $challenger->user,
                        $challengeType
                    );
                }
                dd($actualChallengers);
                if ($challengeType == 'steps') {
                }
                if ($betType == 'personal') {

                }
            }
        }



        dd(fitInfo::resultsArray($request, ChallengesController::getFinishedChallenges()));
        dd(FitInfo::getFriends($request, '4WRC6T'));
//        dd(FitInfo::getDistance($request, '-'));
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
