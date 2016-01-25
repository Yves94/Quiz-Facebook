<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joker extends Model
{

    protected $primaryKey = 'id_joker';

    public $timestamps = false;

    protected $fillable = ['wording_joker','id_action'];

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
