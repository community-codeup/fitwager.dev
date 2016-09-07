<?php
/**
 * Created by PhpStorm.
 * User: tj.becker
 * Date: 9/2/16
 * Time: 11:12 AM
 */

namespace App;


use Illuminate\Http\Request;
use Exception;
use Jmitchell38488\OAuth2\Client\Provider\FitBitAuthorization;

class FitibitToken
{
    public static function refreshToken($user)
    {

        //if (!$user->hasExpiredToken()) {
        //    return;
        //}

        $provider = new FitBitAuthorization([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_SECRET'),
            'redirectUri' => env('FITBIT_REDIRECT_URI'),
        ]);

        $token = base64_encode(sprintf('%s:%s', env('FITBIT_KEY'), env('FITBIT_SECRET')));
        $accessToken = $provider->getAccessToken('refresh_token', [
            'grant_type' => FitBitAuthorization::GRANTTYPE_REFRESH,
            'access_token' => $user->fitbit_token,
            'refresh_token' => $user->fitbit_refresh_token,
            'token' => $token,
        ]);

        $user->fitbit_token = $accessToken->getToken();
        $user->fitbit_token_expiration = $accessToken->getExpires();
        $user->fitbit_refresh_token = $accessToken->getRefreshToken();
        $user->save();
    }

    public static function refresh(Request $request)
    {
        $provider = new FitBitAuthorization([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_SECRET'),
            'redirectUri' => env('FITBIT_REDIRECT_URI'),
        ]);

        // 1st step: Has the user authorised yet?
        if (session()->has('oauth2state')) {
            $authorizationUrl = $provider->getAuthorizationUrl([
                'prompt' => FitBitAuthorization::PROMPT_CONSENT,
                'response_type' => FitBitAuthorization::RESPONSETYPE_CODE,
                'scope' => $provider->getAllScope(),
            ]);

            // Set the session state to validate in the callback
            session(['oauth2state' => $provider->getState()]);
            redirect()->to($authorizationUrl)->send();

        // 2nd step: User has authorised, now lets get the refresh & access tokens
        } else if ($request->has('state') && $request->get('state') == session('oauth2state') && $request->has('code') && !isset(session('fitbit')['oauth'])) {
            try {
                $token = base64_encode(sprintf('%s:%s', env('FITBIT_KEY'), env('FITBIT_SECRET')));
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' =>  $request->get('code'),
                    'access_token' =>  $request->get('code'),
                    'token' => $token,
                ]);

                session()->forget('oauth2state');
                session([
                    'fitbit' => [
                        'oauth2' => [
                            'accessToken' => $accessToken->getToken(),
                            'expires' => $accessToken->getExpires(),
                            'refreshToken' => $accessToken->getRefreshToken(),
                        ]
                    ]
                ]);
            } catch (Exception $ex) {
                print $ex->getMessage();
            }

        // 3rd step: Authorised, have tokens, but session needs to be refreshed
        } else if (time() > session('fitbit')['oauth2']['expires']) {
            try {
                $token = base64_encode(sprintf('%s:%s', env('FITBIT_KEY'), env('FITBIT_SECRET')));
                $accessToken = $provider->getAccessToken('refresh_token', [
                    'grant_type' => FitBitAuthorization::GRANTTYPE_REFRESH,
                    'access_token' => $_SESSION['fitbit']['oauth2']['accessToken'],
                    'refresh_token' => $_SESSION['fitbit']['oauth2']['refreshToken'],
                    'token' => $token,
                ]);

                session()->forget('oauth2state');
                session([
                    'fitbit' => [
                        'oauth2' => [
                            'accessToken' => $accessToken->getToken(),
                            'expires' => $accessToken->getExpires(),
                            'refreshToken' => $accessToken->getRefreshToken(),
                        ]
                    ]
                ]);
            } catch (Exception $ex) {
                print $ex->getMessage();
            }
        }

    }
}