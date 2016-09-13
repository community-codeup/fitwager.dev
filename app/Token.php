<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\OAuth2\Client\Token\AccessToken;
use Log;

class Token extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'resource_owner_id';
    protected $fillable = [
        'access_token',
        'resource_owner_id',
        'refresh_token',
        'expires_in',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'resource_owner_id', 'fitbit_id');
    }

    public function oauthToken()
    {
        return new AccessToken([
            'access_token' => $this->attributes['access_token'],
            'resource_owner_id' => $this->attributes['resource_owner_id'],
            'refresh_token' =>$this->attributes['refresh_token'],
            'expires' => $this->attributes['expires_in'],
        ]);
    }

    public function renew(array $newValues)
    {
        Log::info($newValues);
        $this->access_token = $newValues['access_token'];
        $this->refresh_token = $newValues['refresh_token'];
        $this->expires_in = $newValues['expires_in'];// + $this->owner->utc_offset;
        $this->save();
    }
}
