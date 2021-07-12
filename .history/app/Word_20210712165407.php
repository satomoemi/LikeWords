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
    );

    public function folder()
    {
        return $this->belongsTo('App\Folder');//複数のwordに対し一つのフォルダーを渡すため
    }

    public function user()
    {
        return $this->belongsTo('App\User');//複数のwordに対し一つのuserを渡すため
    }


}
