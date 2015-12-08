<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['wording_answer'];

    public function questions() {
        $this->belongsToMany('App\Question');
    }
}
