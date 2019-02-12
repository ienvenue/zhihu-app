<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function password()
    {
        return view('users.password');
    }
    public function update(ChangePasswordRequest $request)
    {
        if(Hash::check($request->get('old_password'),user()->password)) {
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('ChangePasswordSucceeded','success');
            return back();
        }
        flash('ChangePasswordFailed','danger');
        return back();
    }
}