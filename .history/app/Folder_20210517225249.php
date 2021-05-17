<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' =>  'required',
        'users_id' =>  'required',
        'pushes_id' =>  'required',
        'words_id' =>  'required',
    );

    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function pushes()
    {
        return $this->hasMany('App\User');
    }
    public function words()
    {
        return $this->hasMany('App\User');
    }
}
