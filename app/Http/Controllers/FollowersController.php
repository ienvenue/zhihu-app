<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    protected $user;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $this->user->byId($request->get('user'));
        $followers = $user->followers()->pluck('follower_id')->toArray();
        if (in_array(Auth::guard('api')->user()->id,$followers)){
            return response()->json(['followed'=>true]);
        }
        else
            return response()->json(['followed'=>false]);

    }

    public function follow()
    {
        
    }
}
