<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'player_id' => 'required',
        'push_time' => 'required',
        
        
    );

    public function user()
{
    return $this->belongsTo('App\User');//一つのpushに対して一人のuser hasmanyやhasoneの親
}

}
