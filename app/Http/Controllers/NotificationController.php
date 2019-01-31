<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NotificationController extends Controller
{
    public function index()
    {
        $user=App::user();
        return view('notification.index');
    }
}
