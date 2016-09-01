<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenge extends Model
{
    protected $table = 'challenges';
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
        'url' => 'required|url',
    ];

    public static function findPostBySearch($searchBy, $search) {
        return Post::where($searchBy, 'LIKE', '%' . $search . '%');
    }


}

