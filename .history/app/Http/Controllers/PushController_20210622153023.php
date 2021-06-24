<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PushController extends Controller
{
    public function push()
    {
        return view('user.push');
    }

    public function PushID()
    {
        $user = new User;
        $form = $request->all();

        unset($form['_token']);
        
        $user->fill($form);
        $user->save();
        

        return redirect('/home');
    }


   
}
