<?php

namespace App\Http\Controllers;


use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Class QuestionFollowController
 * @package App\Http\Controllers
 */
class QuestionFollowController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $question;

    /**
     * QuestionFollowController constructor.
     * @param QuestionRepository $question
     */
    public function __construct(QuestionRepository $question)
    {
        $this->middleware('auth');
        $this->question=$question;
    }

    /**
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow($question)
    {
        if (!is_null(Auth::user()))
        {
            Auth::user()->followThis($question);
            return back();
        }
        else
            return redirect('login');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follower(Request $request)
    {
        if(user('api')->followed($request->get('question'))) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function followThisQuestion(Request $request)
    {
        $question = $this->question->byId($request->get('question'));
        $followed = user('api')->followThis($question->id);
        if(count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }
        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
