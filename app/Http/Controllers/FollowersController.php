<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Request;


/**
 * Class FollowersController
 * @package App\Http\Controllers
 */
class FollowersController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $user;


    /**
     * FollowersController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $user=  $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();
        if (in_array(Auth::guard('api')->user()->id,$followers))
        {
            return response()->json(['followed'=>true]);
        }
        else
            return response()->json(['followed'=>false]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow()
    {

        $userToFollow = $this->user->byId(request('user'));

        $followed = user('api')->followThisUser($userToFollow->id);

        if(count($followed['attached']) > 0)
        {
            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('followers_count');
            Auth::guard('api')->user()->increment('followings_count');
            return response()->json(['followed' => true]);
        }
        else{
            $userToFollow->decrement('followers_count');
            Auth::guard('api')->user()->decrement('followings_count');
            return response()->json(['followed' => false]);
        }
    }
}
