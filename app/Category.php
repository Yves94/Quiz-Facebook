<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $primaryKey = 'id_category';
    protected  $fillable = ['wording_category'];

    public $timestamps = false;
 

    public function questions() {
        return $this->belongsToMany('App\Question');
    }
}
