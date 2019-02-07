<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/1/26
 * Time: 23:05
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{
    /**
     * @param array $attributes
     * @return \App\Answer
     */
    public function create(array $attributes)
    {
        return Answer::create($attributes);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments', 'comments.user')->where('id', $id)->first();
        return $answer->comments;
    }
}