<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{
    /**
     * @var AnswerRepository
     */
    protected $answer;

    /**
     * AnswerController constructor.
     * @param AnswerRepository $answer
     */
    public function __construct(AnswerRepository $answer)
    {

        $this->answer=$answer;
    }

    /**
     * @param StoreAnswerRequest $request
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnswerRequest $request, $question)
    {
        $answer=$this->answer->create([
            'question_id'=>$question,
            "user_id"=>Auth::id(),
            'body'=>$request->get('body')
        ]);
        $answer->question()->increment('answers_count');
        return back();
    }
}
