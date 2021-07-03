<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 
        'player_id'
        'push_time'
        ,
        
    );
}
