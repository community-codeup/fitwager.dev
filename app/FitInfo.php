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

    public static function activities(Request $request, $fitbit_id)
    {
        FitibitToken::refresh($request);

        $provider = new FitBit([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_KEY'),
            'redirectUri' => env('FITBIT_KEY'),
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

    public static function getFriends(Request $request, $fitbit_id) {
        FitibitToken::refresh($request);

        $provider = new FitBit([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_KEY'),
            'redirectUri' => env('FITBIT_KEY'),
        ]);
        $endpoint = $provider->getBaseApiUrl() . "user/" . $fitbit_id . "/friends" . '.' . FitBit::FORMAT_JSON;

        $request = $provider->getAuthenticatedRequest(
            FitBit::METHOD_GET,
            $endpoint,
            session('fitbit')['oauth2']['accessToken']
        );

        $response = $provider->getResponse($request);
        return $response;
    }


    public static function getSteps(Request $request, $fitbit_id)
    {
        $response = static::activities($request, $fitbit_id);
        $steps = $response['summary']['steps'];
        return $steps;
    }

    public static function getCalories(Request $request, $fitbit_id)
    {
        $response = static::activities($request, $fitbit_id);
        $calories = $response['summary']['caloriesOut'];
        return $calories;
    }

    public static function getDistance(Request $request, $fitbit_id)
    {
        $response = static::activities($request, $fitbit_id);
        $distance = $response['summary']['distances'][0]['distance'];
        return $distance;
    }

    public static function resultsArray(Request $request, array $challengers)
    {
        foreach($challengers as $challenger) {
            $response = static::activities($request, $challenger->fitbit_id);
            $resultsArray[] = [
                "$challenger->fitbit_id" => [
                    'steps' => $response['summary']['steps'],
                    'calories' => $response['summary']['caloriesOut'],
                    'distance' => $response['summary']['distances'][0]['distance']
                ]
            ];
        }
        return $resultsArray;
    }
}