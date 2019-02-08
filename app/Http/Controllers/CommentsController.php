<?php

namespace App\Http\Controllers;

use Auth;
use App\Answer;
use App\Comment;
use App\Question;

class CommentsController extends Controller
{
    //get comments of Answers by Id
    public function answer($id)
    {
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();
        return $answer->comments;
    }
    //get comments of Question by Id
    public function question($id)
    {
        $question = Question::with('comments','comments.user')->where('id',$id)->first();
        return $question->comments;
    }
    //store comments
    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));
        $comment = Comment::create([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')
        ]);
        return $comment;
    }
    //judge comment from Q or A
    private function getModelNameFromType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
