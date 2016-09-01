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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('views/account', function () {
    return view('account');
});

Route::get('/auth/fitbit', 'Auth\AuthController@redirectToProvider');
Route::get('/auth/fitbit/callback', 'Auth\AuthController@handleProviderCallback');


Route::get('/test', "UsersController@index");
Route::get('/account', "UsersController@store");

Route::resource('challenges', 'ChallengesController');

Route::get('challenges', function() {
    $betTypes = BetType::all();
    $challengeTypes = ChallengeType::all();
    $data = [
        'betTypes' => $betTypes,
        'challengeTypes' => $challengeTypes,
    ];
    return view('tj_challenges', $data);
});
