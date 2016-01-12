<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id_user';
    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];

    public function quizs() {
        return $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
         return $this->belongsToMany('App\Joker');
    }

}
