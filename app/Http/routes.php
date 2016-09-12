<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\BetType;
use App\ChallengeType;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Challenge;
use App\Challenger;

Route::get('/', function () {
    $data = [
        'authCheck' => Auth::check(),
        'userCoins' => User::userCount(),
        'challengesWon' => Challenger::challengeWinners(),
    ];

    return view('welcome', $data);
});


Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('user/account', function() {
    return redirect()->action('UsersController@show', Auth::id());
});

Route::get('/about', function () {
    return view('/about');
});

Route::get('/auth/fitbit', 'FitbitAuthenticationController@redirectToProvider');
Route::get('/auth/fitbit/callback', 'FitbitAuthenticationController@handleProviderCallback');

Route::resource('users', 'UsersController');
Route::get('/test', "ResultsController@index");
Route::get('/account', "UsersController@store");


Route::resource('challenges', 'ChallengesController');
Route::get('acceptchallenge/{challengeId}', 'ChallengesController@acceptChallenge');
Route::get('challenges/result/{challengeId}', 'ChallengesController@result');

// Route::get('/test22',function(){
//  	return Auth::user()->challengeCount();
// });

//Route::get('challenges', function() {
//    $betTypes = BetType::all();
//    $challengeTypes = ChallengeType::all();
//    $users = User::all();
//    $data = [
//        'betTypes' => $betTypes,
//        'challengeTypes' => $challengeTypes,
//        'users' => $users,
//    ];
//    return view('tj_challenges', $data);
//});


