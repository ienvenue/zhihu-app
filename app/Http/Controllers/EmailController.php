<?php

namespace App\Http\Controllers;
use App\User;
use
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verify($token)
    {
        $user=User::where('comfirmation_token',$token)->first();
        if (is_null($user))
        {
            //add something you want to tell user
            return redirect('/');
        }
        $user->is_active=1;
        $user->confirmation_token=str_random(40);
        $user->save();
        Auth::login($user);
        return redirect('/home');
    }
}
