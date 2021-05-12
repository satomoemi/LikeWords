<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unsubscribe extends Model
{
   
    protected $guarded = array('id');

    public static $rules = array(
        'reason' => 'required',
    );
}
