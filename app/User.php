<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $primaryKey = 'id_user';

    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];

    public function quizs() {
        $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
        $this->belongsToMany('App\Joker');
    }

    public static  function updateOrCreate(array $attributes, array $values = [])
	{
		$user = new User();
		$instance = $user->firstOrNew($attributes);
	    	
	    $instance->fill($values);

	    $instance->save();

	    return $instance;
		}

}
