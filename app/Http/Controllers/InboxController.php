<?php

namespace App\Http\Controllers;



/**
 * Class InboxController
 * @package App\Http\Controllers
 */
class InboxController extends Controller
{

    /**
     * InboxController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = user()->messages->groupBy('from_user_id');
        return view('inbox.index',compact('messages'));
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function show($userId)
    {
        $message=\App\Message::where('from_user_id',$userId)->get();
        return $message;
    }
}
