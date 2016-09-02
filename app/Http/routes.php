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

Route::get('/', function () {
//    dd(Auth::user());
    return view('welcome');
});

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('user/account', function () {
    return view('user/account');
});


Route::get('/auth/fitbit', 'Auth\AuthController@redirectToProvider');
Route::get('/auth/fitbit/callback', 'Auth\AuthController@handleProviderCallback');

Route::resource('users', 'UsersController');
Route::get('/test', "ResultsController@index");
Route::get('/account', "UsersController@store");


Route::resource('challenges', 'ChallengesController');

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


