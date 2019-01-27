<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\User;

/**
 * Class QuestionFollowController
 * @package App\Http\Controllers
 */
class QuestionFollowController extends Controller
{
    /**
     * QuestionFollowController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
}
