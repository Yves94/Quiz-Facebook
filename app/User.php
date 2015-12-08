<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey ='id_user';
    public $timestamps = false;
}