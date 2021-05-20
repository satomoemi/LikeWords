<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'word' =>  'required',
        'memo' =>  'required',
        'us_id' =>  'required',
        'words_id' =>  'required',
    );
}
