<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;


class EmailController extends Controller
{
    public function verify($token)
    {
        $user=User::where('confirmation_token',$token)->first();
        if (is_null($user))
        {
            flash('Failed to register!','danger');//add something you want to tell user
            return redirect('/');
        }
        $user->is_active=1;
        $user->confirmation_token=str_random(40);
        $user->save();
        Auth::login($user);
        flash('Succeeded to register!','success');//add something you want to tell user
        return redirect('/home');
    }
}
