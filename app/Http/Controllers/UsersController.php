<?php

namespace App\Http\Controllers;

use App\Challenger;
use App\User;
use App\Challenge;
use Illuminate\Http\Request;
use App\FitInfo;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;
use DateTime;
use Jmitchell38488\OAuth2\Client\Provider\FitBit;
use Jmitchell38488\OAuth2\Client\Provider\FitBitImplicit;

class UsersController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calories = FitInfo::weeklyCalories(Auth::user());
        $series = [];
        $dataCalories = [];
        foreach ($calories['activities-calories'] as $calorie) {
//            dd($calorie);
            $series[] = $calorie['dateTime'];
            $dataCalories[] = $calorie['value'];
        }
        $steps = FitInfo::weeklySteps(Auth::user());
        $dataSteps = [];
        foreach ($steps['activities-steps'] as $step) {
            $dataSteps[] = $step['value'];
        }
        $distance = FitInfo::weeklyDistance(Auth::user());
        $dataDistance = [];
        foreach ($distance['activities-distance'] as $distance) {
            $dataDistance[] = $distance['value'];
        }
        return['categories' => $series, 'calories' => $dataCalories, 'steps' => $dataSteps, 'distance' => $dataDistance];
    }

    public function acceptChallenge($id) {
        $updateChallenger = new Challenger;
        $updateChallenger->id = $id;
        $updateChallenger->status = 'accepted';
        $updateChallenger->save();
    }

    public function welcome() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::check()){
            return view('auth/login');
        } else {
            Auth::store();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if(Auth::check()){
            $calories = FitInfo::weeklyCalories(Auth::user());
            $series = [];
            $dataCalories = [];
            foreach ($calories['activities-calories'] as $calorie) {
//            dd($calorie);
                $series[] = $calorie['dateTime'];
                $dataCalories[] = (int) $calorie['value'];
            }
            $steps = FitInfo::weeklySteps(Auth::user());
            $dataSteps = [];
            foreach ($steps['activities-steps'] as $step) {
                $dataSteps[] = (int) $step['value'];
            }
            $distance = FitInfo::weeklyDistance(Auth::user());
            $dataDistance = [];
            foreach ($distance['activities-distance'] as $distance) {
                $dataDistance[] = (float) $distance['value'] * 1000;
            }
            $graphInfo = ['categories' => $series, 'calories' => $dataCalories, 'steps' => $dataSteps, 'distance' => $dataDistance];
            $data = [
                //'calories'=>$steps,
                //'calories'=>$calories,
                'graphInfo' => $graphInfo,
                'user'=>Auth::user(),
            ];
            return view('user.account')->with($data);
        } else{
            return redirect()->action('welcome');
        }

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

    public function alreadyCreated($id) {
        if (User::find($id)) {
            return true;
        } else {
            return false;
        }
    }
}
