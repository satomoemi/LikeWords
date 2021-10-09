<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
    //メール送る上で必須
    use Notifiable;

    /**
     * パスワード再設定メールの送信
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

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
    public function words()
{
    return $this->hasMany('App\Word');//一つのuserに対して複数のword
}

    public function pushes()//hasmanyやhasoneは複数形
{
    return $this->hasOne('App\Push');//一つのpushに対して一人のuser belongsToの子
}
}
