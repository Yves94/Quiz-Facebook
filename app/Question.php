<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['wording_question'];

    public function quizs() {
        $this->belongsToMany('App\Quiz');
    }

    public function categories() {
        $this->belongsToMany('App\Category');
    }

    public function answers() {
        $this->belongsToMany('App\Answer');
    }
}


