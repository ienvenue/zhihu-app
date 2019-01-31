<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('notifications.index',compact('user'));
    }
}
