<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/* si probleme test extends eloquant*/
class User extends Model
{
    use EntrustUserTrait;
    protected $primaryKey='id_user';
    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];

    public function quizs() {
        $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
        $this->belongsToMany('App\Joker');
    }

}
