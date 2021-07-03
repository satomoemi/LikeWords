<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'player_id'
        'push_time'
        ,
        
    );

    public function folders()
{
    return $this->hasMany('App\Folder');//一つのuserに対して複数のfolder
}
}
