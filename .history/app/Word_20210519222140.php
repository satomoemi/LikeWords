<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'word' =>  'required',
        'memo' =>  'required',
        'folders_id' =>  'required',
        'pushes_id' =>  'required',
    );

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
