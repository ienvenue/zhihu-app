<?php

namespace App\Http\Controllers;



use App\Message;

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
//        $messages = user()->messages->groupBy('from_user_id');
//        return view('inbox.index',compact('messages'));
        $messages = Message::where('to_user_id',user()->id)
            ->orWhere('from_user_id',user()->id)
            ->with(['fromUser','toUser'])->get();
        return view('inbox.index',['messages' => $messages->groupBy('to_user_id') ]);
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function show($dialogId)
    {
        $messages = Message::where('dialog_id',$dialogId)->get();
        return $messages;
    }
}
