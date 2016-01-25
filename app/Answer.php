<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $primaryKey = 'id_answer';

    public $timestamps = false;

    protected $fillable = ['wording_answer'];

    public function questions() {
        return $this->belongsToMany('App\Question');
    }
}
