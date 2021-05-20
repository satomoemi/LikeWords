<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' =>  'required',
        'users_id' =>  'required',
        'pushes_id' =>  'required',
        'words_id' =>  'required',
    );
}
