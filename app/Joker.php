<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joker extends Model
{
    public $timestamps = false;
    protected $fillable = ['wording_joker','id_action'];

    public function users() {
        $this->belongsToMany('App\User');
    }
}
