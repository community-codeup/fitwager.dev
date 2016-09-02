<?php
/**
 * Created by PhpStorm.
 * User: tj.becker
 * Date: 9/2/16
 * Time: 3:03 PM
 */

namespace App;

use App\FitibitToken;
use Illuminate\Http\Request;
use App\Results;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jmitchell38488\OAuth2\Client\Provider\FitBit;

class FitInfo
{

    public static function index(Request $request, $fitbit_id)
    {
        FitibitToken::refresh($request);

        $provider = new FitBit([
            'clientId'      => env('FITBIT_KEY'),
            'clientSecret'  => env('FITBIT_KEY'),
            'redirectUri'   => env('FITBIT_KEY'),
        ]);
        $today = new \DateTime();
        $endpoint = $provider->getBaseApiUrl() . "user/" . $fitbit_id . "/activities/date/" . $today->format('Y-m-d') . '.' . FitBit::FORMAT_JSON;

        $request = $provider->getAuthenticatedRequest(
            FitBit::METHOD_GET,
            $endpoint,
            session('fitbit')['oauth2']['accessToken']
        );

        $response = $provider->getResponse($request);

        return $response;
    }


}