<?php
/**
 * Created by PhpStorm.
 * User: tj.becker
 * Date: 9/2/16
 * Time: 3:03 PM
 */

namespace App;

use DateTime;
use djchen\OAuth2\Client\Provider\Fitbit;
use Illuminate\Http\Request;
use App\User;


class FitInfo
{
    private static $provider;

    public static function activities($user)
    {
        $provider =  self::provider();

        $request = $provider->getAuthenticatedRequest(
            'GET',
            Fitbit::BASE_FITBIT_API_URL . '/1/user/' . $user->fitbit_id . '/activities/date/'. (new DateTime())->format('Y-m-d') . '.json',
            self::getAccessTokenFor($user)
        );
        $response = $provider->getResponse($request);

        return $response;
    }

    public static function detailedCalories($user)
    {
        // /1/user/-/activities/calories/date/2014-09-01/1d/15min/time/12:30/12:45.json
        //dd(Fitbit::BASE_FITBIT_API_URL . '/1/user/' . $user->fitbit_id . '/activities/calories/date/'. (new DateTime())->format('Y-m-d') . '/1d/60min/00:00/24:00.json');
        $provider =  self::provider();

        $request = $provider->getAuthenticatedRequest(
            'GET',
            Fitbit::BASE_FITBIT_API_URL . '/1/user/-/activities/steps/date/today/1m.json',
            self::getAccessTokenFor($user)
        );
        $response = $provider->getResponse($request);

        return $response;

    }

    private static function provider()
    {
        if (!self::$provider) {
            self::$provider = new Fitbit([
                'clientId' => env('FITBIT_KEY'),
                'clientSecret' => env('FITBIT_SECRET'),
                'redirectUri' => env('FITBIT_REDIRECT_URI'),
            ]);
        }

        return self::$provider;
    }

    private static function getAccessTokenFor(User $user)
    {
        $token = $user->token;
        $accessToken = $token->oauthToken();
        if ($accessToken->hasExpired()) {
            $newAccessToken = self::provider()->getAccessToken('refresh_token', [
                'refresh_token' => $accessToken->getRefreshToken()
            ]);
            $token->renew($newAccessToken->getValues());
            $accessToken = $newAccessToken;
        }

        return $accessToken;
    }

    public static function getFriends(User $user) {

        $provider = self::provider();


        $request = $provider->getAuthenticatedRequest(
            'GET',
            Fitbit::BASE_FITBIT_API_URL . '/1/user/' . $user->fitbit_id . '/friends.json',
            self::getAccessTokenFor($user)
        );
        $response = $provider->getResponse($request);


//        $endpoint = $provider->getBaseApiUrl() . "user/" . $fitbit_id . "/friends" . '.' . FitBit::FORMAT_JSON;
//
//        $request = $provider->getAuthenticatedRequest(
//            FitBit::METHOD_GET,
//            $endpoint,
//            session('fitbit')['oauth2']['accessToken']
//        );
//
//        $response = $provider->getResponse($request);
        return $response;
    }

    public static function getStat($user, $stat) {

        $response = static::activities($user);

        if($stat == 'distance') {
            return $response['summary']['distances'][0]['distance'];
        }

        return $response['summary'][$stat];
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