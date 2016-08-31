<?php

namespace App;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Challenges extends BaseModel
{
    protected $table = 'posts';
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
        'url' => 'required|url',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public static function findPostBySearch($searchBy, $search) {
        return Post::where($searchBy, 'LIKE', '%' . $search . '%');
    }
}

