<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' =>  'required',
        'user_id'=> 'required',
    );

    public function words()
    {
        //folderテーブルに関連しているwordテーブルのレコードを全て取得している
        return $this->hasMany('App\Word');//1つのfolderに対して複数のword
    }

    public function user()
{
    return $this->belongsTo('App\User');//複数のfolderに対して一つのuser
}

}
