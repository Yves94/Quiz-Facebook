<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/* si probleme test extends eloquant*/
class User extends Model
{
	use EntrustUserTrait; //add this trait to your user model

	
	protected $primaryKey = 'id_user';//defini the primary key 

    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];


    // Relation 
    public function quizs() {
        $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
        $this->belongsToMany('App\Joker');
    }


    //Create or update an user 
    public static  function updateOrCreate(array $attributes, array $values = [])
	{
		$user = new User();
		$instance = $user->firstOrNew($attributes);
	    	
	    $instance->fill($values);

	    $instance->save();

	    return $instance;
	}

}
