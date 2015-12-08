<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];

    public function quizs() {
        $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
        $this->belongsToMany('App\Joker');
    }

}
