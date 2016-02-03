<?php

namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/* si probleme test extends eloquant*/
class User extends  Model implements AuthenticatableContract
{

	use EntrustUserTrait; //add this trait to your user model
	use Authenticatable;

	protected $primaryKey = 'id_user'; //defini the primary key 
 	protected $table = 'users';

    protected $fillable=['last_name','first_name','email','age_rangs','birthday','gender'];

  	protected $hidden = ['password', 'remember_token'];
    // Relation 
    public function quizs() {
        return $this->belongsToMany('App\Quiz');
    }

    public function jokers() {
         return $this->belongsToMany('App\Joker');
    }


    //Create or update an user 
    public static  function updateOrCreate(array $attributes, array $values = [])
	{
		$user = new User();
		$instance = $user->firstOrNew($attributes);
	    	
	    $instance->fill($values);

	    $instance->save();

	    /* //attach Role to user   
        $admin = new Role();
        $admin = Role::where('name','=','Admin')->first();
        $current_user->attachRole($admin);
		*/
	    return $instance;
	}

}
