<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

/**
 * Class QuestionFollowController
 * @package App\Http\Controllers
 */
class QuestionFollowController extends Controller
{
    /**
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow($question)
    {
        Auth::user()->follows($question);
        return back();
    }
}
