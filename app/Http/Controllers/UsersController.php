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
        session_start();

        $provider = new FitBit([
            'clientId'      => env('FITBIT_KEY'),
            'clientSecret'  => env('FITBIT_SECRET'),
            'redirectUri'   => env('FITBIT_REDIRECT_URI'),
        ]);
        $today = new DateTime();
        $endpoint = $provider->getBaseApiUrl() . "user/". $_SESSION['fitbit']['oauth2']['user-id'] . "/activities/date/"
            . $today->format('Y-m-d') . '.' . FitBit::FORMAT_JSON;
        var_dump($endpoint);

        $request = $provider->getAuthenticatedRequest(
            FitBit::METHOD_GET,
            $endpoint,
            $_SESSION['fitbit']['oauth2']['accessToken']
        );

        $response = $provider->getResponse($request);
        dd($response);
        return 'Yay!';
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
            $response = FitInfo::detailedCalories(Auth::user());
//            dd($response);
            $data = [
                //'calories'=>$steps,
                //'calories'=>$calories,
                //'distance'=>$distance,
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
