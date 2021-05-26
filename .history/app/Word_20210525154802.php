<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'folder_id' =>  'required',
        'word' =>  'required',
        'memo' =>  'required',
        // 'pushes_id' =>  'required',
    );

    public function folders()
    {
        return $this->hasMany('App\Folder');
    }

    // public function pushes()
    // {
    //     return $this->hasMany('App\Push');
    // }


}