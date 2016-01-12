<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = 'id_answer';
    protected $fillable = ['wording_answer'];

    public function questions() {
        return $this->belongsToMany('App\Question');
    }
}
