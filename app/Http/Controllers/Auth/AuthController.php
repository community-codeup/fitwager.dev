<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Log;
use Validator;
use Socialite;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('fitbit')->stateless(false)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $fitbit_user = Socialite::driver('fitbit')->stateless(true)->user();

        //dd($user);
        $user = User::firstOrCreate([
            'fitbit_id' => $fitbit_user->id,
        ]);
        $user->name = $fitbit_user->user['user']['fullName'];
        $user->email = $fitbit_user->email;
        $user->picture = $fitbit_user->avatar;
        $user->save();

        Auth::login($user);
//        if (!User::alreadyCreated($fitbit_user->id)) {
//            User::create([
//                'name' => $fitbit_user->user['user']['fullName'],
//                'fitbit_id' => $fitbit_user->id,
//                'email' => $fitbit_user->email,
//                'picture' => $fitbit_user->avatar,
//            ]);
//        }

        //dd($user);
        return redirect()->action('UsersController@show', $user->id);
        //die;
        //dd($user, $_SESSION);
        ////print_r($json);
        //dd($user);
        //Log::info($user);
        // $user->token;
    }
}
