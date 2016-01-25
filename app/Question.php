<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $primaryKey = 'id_question';

    public $timestamps = false;

    protected $fillable = ['wording_question'];

    public function quizs() {
        return $this->belongsToMany('App\Quiz');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function answers() {
        return $this->belongsToMany('App\Answer');
    }
}


