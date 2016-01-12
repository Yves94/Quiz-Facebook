<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $primaryKey = 'id_quiz';
    protected $fillable=['title','slug','nb_question','summary','picture','start_date','end_start'];

    public function users() {

        return $this->belongsToMany('App\User');
    }

    public function questions() {

        return $this->belongsToMany('App\Question');
    }
}
