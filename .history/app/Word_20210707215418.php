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

    public function folder()
    {
        return $this->belongsTo('App\Folder');//複数のwordに対し一つのフォルダーを渡すため
    }
    
    public function folder()
    {
        return $this->belongsTo('App\Folder');//複数のwordに対し一つのフォルダーを渡すため
    }


}
