<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $primaryKey = 'id_question';
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
    public function getCategoriesIdToArray()
    {
        $array = [];
        $category = $this->categories()->get();
        foreach($category as $k => $v) {
            $array[] = $v->id_category;
        }
        return $array;
    }
}


