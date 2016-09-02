<?php

namespace App\Http\Controllers;

use App\FitibitToken;
use Illuminate\Http\Request;
use App\Results;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        FitibitToken::refresh($request);

        $provider = new FitBit([
            'clientId'      => env('FITBIT_KEY'),
            'clientSecret'  => env('FITBIT_KEY'),
            'redirectUri'   => env('FITBIT_KEY'),
        ]);
        $endpoint = $provider->getBaseApiUrl() . "user/-/activities/steps." . FitBit::FORMAT_JSON;

        $request = $provider->getAuthenticatedRequest(
            FitBit::METHOD_GET,
            $endpoint,
            session('fitbit')['oauth2']['accessToken']
        );

        $response = $provider->getResponse($request);

        Results::showResults();
        return view('challenge_results');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Result::findOrFail($id)
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
