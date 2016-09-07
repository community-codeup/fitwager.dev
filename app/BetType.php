<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetType extends Model
{
    protected $table = 'bet_types';
    protected $fillable = [
        'name',
        'description',
    ];

    public function challenge() {
        return $this->hasOne(Challenge::class);
    }
}
