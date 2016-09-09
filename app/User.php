<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'fitbit_id', 'picture', 'coins'];


    public function token()
    {
        return $this->hasOne(Token::class, 'resource_owner_id', 'fitbit_id');
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class, 'challenges_id');
    }

    public static function getChallenges(){
        $challenges = DB::table('challenges')
            ->join('users', 'challenges.created_by', '=', 'users.id')
            ->join('bet_types', 'challenges.bet_type', '=', 'bet_types.id')
            ->join('challenge_types', 'challenges.challenge_type', '=', 'challenge_types.id')
            ->join('user_results', 'users.fitbit_id', '=', '');
        }    
    public function challenger() {
        return $this->hasOne(Challenger::class);
    }
   
    public function challengeCount()
    {
       return count(Challenge::getPendingChallenges());
    }

    public static function userCount()
    {
        return $userCoins = User::orderBy('users.coins', 'desc')->take(8)->get();
    }

    public static function coinsLeader()
    {

        // $userCoins = static::userCount();
        // $userCoins = $userCoins
        //         ->select(
        //             'name as User Name',
        //             'coins AS User Coins'
        //             );
        // return $userCoins->get();
        // return $userCoins = User::limit(5)->orderBy('coins', 'desc')->pluck('coins');
    }


}
