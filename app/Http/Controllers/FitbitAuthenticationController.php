<?php

namespace App\Http\Controllers;

use App\Token;
use App\User;
use App\Challenge;
use djchen\OAuth2\Client\Provider\Fitbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class FitbitAuthenticationController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        $provider = new Fitbit([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_SECRET'),
            'redirectUri' => env('FITBIT_REDIRECT_URI'),
        ]);
        if (!$request->has('code')) {
            $authorizationUrl = $provider->getAuthorizationUrl();
            session()->put('oauth2state', $provider->getState());
            return redirect()->to($authorizationUrl);
        }
    }

    public function handleProviderCallback(Request $request)
    {
        $provider = new Fitbit([
            'clientId' => env('FITBIT_KEY'),
            'clientSecret' => env('FITBIT_SECRET'),
            'redirectUri' => env('FITBIT_REDIRECT_URI'),
        ]);
        if (!$request->has('state') || $request->get('state') !== session('oauth2state')) {
            session()->forget('oauth2state');
            abort(404);
        } else {
            try {
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $request->get('code'),
                ]);
                $resourceOwner = $provider->getResourceOwner($accessToken)->toArray();
                $owner = User::firstOrCreate([
                    'fitbit_id' => $resourceOwner['encodedId'],
                ]);
                $owner->name = $resourceOwner['fullName'];
                $owner->picture = $resourceOwner['avatar150'];
                $owner->utc_offset = $resourceOwner['offsetFromUTCMillis'];
                $owner->save();
                
                if ($owner->coins == null) {
                    $owner->coins = 20;
                    $owner->save();
                }
                $tokenDetails = [
                    'access_token' => $accessToken->getToken(),
                    'resource_owner_id' => $owner->fitbit_id,
                    'refresh_token' => $accessToken->getRefreshToken(),
                    'expires_in' => $accessToken->getExpires(),
                ];
                if (!$owner->token) {
                    Token::create($tokenDetails);
                } else {
                    $owner->token->renew($tokenDetails);
                }
                Auth::login($owner);

                return redirect()->action('UsersController@show', $owner->id);

            } catch (IdentityProviderException $e) {
                abort(404);
            }
        }
    }
}
