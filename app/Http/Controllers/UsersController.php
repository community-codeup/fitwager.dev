<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Auth;
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
        var_dump($_SESSION);
return;

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
    public function show($id, $user)
    {
        //
        if(!Auth::check()){
            return view(auth/login);
        } else{
            return redirect;
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
