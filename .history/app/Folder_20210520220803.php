<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' =>  'required',
        
        'pushes_id' =>  'required',
        'words_id' =>  'required',
    );



    public function pushes()
    {
        //Push.phpでclass Push と定義されてるだから$this使う
        return $this->hasMany('App\Push');
    }
}
