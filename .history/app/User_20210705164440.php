<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //$fillableは必須項目(required的な)ホワイトリスト方式
    protected $fillable = [
        'name', 'email', 'birthday', 'gender', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //型変換する所
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function folders()
{
    return $this->hasMany('App\Folder');//一つのuserに対して複数のfolder
}

    public function user()
{
    return $this->belongsTo('App\User');//一つのpushに対して一人のuser
}
}
