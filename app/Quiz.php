<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz';
    protected $primaryKey ='id_quiz';
    public $timestamps = false;
}
