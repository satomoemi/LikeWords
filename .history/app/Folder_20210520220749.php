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



    public function pushes()
    {
        //Push.phpでclass Push と定義されてるだから$this使う
        return $this->hasMany('App\Push');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
