<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' =>  'required',
        'user_id'=> 'required',
        // 'pushes_id' =>  'required',
    );
}
