<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' =>  'required',
        // 'pushes_id' =>  'required',
    );

    public function words()
    {
        return $this->hasMany('App\Word');
    }
    
    
    public function pushes()
    {
        //Push.phpでclass Push と定義されてるだから$this使う
        return $this->hasMany('App\Push');
    }

}
