<?php
namespace App\Http\Controllers;




use Storage;
use Illuminate\Http\Request;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function avatar()
    {
        return view('users.avatar');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function changeAvatar(Request $request)
    {
        $file = $request->file('img');
        $filename = md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('avatars'),$filename);
        user()->avatar='/avatars/'.$filename;
        user()->save();
        return ['url'=>user()->avatar];

    }
}