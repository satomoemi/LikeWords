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
    //$fillableは必須項目(required的な)
    protected $fillable = [
        'name', 'email','birthday','gender', 'password',
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
    //<?php
    // 自分の得意な言語で
    // Let's チャレンジ！！
    $input_line1 = fgets(STDIN);
    [$zikokunagasa, $x_1, $y_1] = explode(" ",$input_line1);
    
    for ($i = 0; $i < $zikokunagasa; $i++) {
        $input_line2 = fgets(STDIN);
        [$x_2, $y_2] = explode(" ",$input_line2);
        // var_dump($x_2);
        
        $x_1 += $x_2;
        $y_1 += $y_2;
        
        if ($y_1 <= 0 ) {
            
        }
         
    }
    echo($x_1);
    
?>
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function folders()
{
    return $this->hasMany('App\Folder');//一つのuserに対して複数のfolder
}

}
