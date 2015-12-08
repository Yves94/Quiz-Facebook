<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{

    protected $fillable=['title','slug','nb_question','summary','picture','start_date','end_start'];

    public function users() {

        $this->belongsToMany('App\User');
    }

    public function questions() {

        $this->belongsToMany('App\Question');
    }
}
