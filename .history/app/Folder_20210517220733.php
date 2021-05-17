<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' =>  'required',
        '' =>  'required',
        'name' =>  'required',
        'name' =>  'required',
    )
}
