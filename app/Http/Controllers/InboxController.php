<?php

namespace App\Http\Controllers;





use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;

/**
 * Class InboxController
 * @package App\Http\Controllers
 */
class InboxController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $message;

    /**
     * InboxController constructor.
     * @param MessageRepository $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth');
        $this->message=$message;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $messages = user()->messages->groupBy('from_user_id');
//        return view('inbox.index',compact('messages'));
        $messages = $this->message->getAllMessages();

        return view('inbox.index',['messages' => $messages->groupBy('dialog_id') ]);
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function show($dialogId)
    {
        $messages = $this->message->getDialogMessagesBy($dialogId);
        $messages->markAsRead();
        return view('inbox.show',compact('messages','dialogId'));
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($dialogId)
    {
        $message = $this->message->getSingleMessageBy($dialogId);
        $toUserId=$message->from_user_id ===user()->id ? $message->to_user_id:$message->from_user_id;
        $newMessage=$this->message->create([
            'from_user_id'=>user()->id,
            'to_user_id'=>$toUserId,
            'body'=>request('body'),
            'dialog_id'=>$dialogId
        ]);
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
        return back();
    }
}
