<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeType extends Model
{
    protected $table = 'challenge_types';

    public function getTypeName($id) {
        return ChallengeType::where('id', $id)->first()->value('name');
    }
}
