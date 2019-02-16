<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/9
 * Time: 10:36
 */

namespace App\Repositories;



use App\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    public function getTopicsForTagging(Request $request)
    {
        return Topic::select(['id','name'])
            ->where('name','like','%'.$request->query('q').'%')
            ->get();
    }

    public function showTopicNameby($topicId)
    {
        return Topic::select(['name'])->where('id',$topicId)->first();
    }

    public function showQuestionby($topicId)
    {
        $topic=Topic::query()->findOrFail($topicId);
        $questions=$topic->questions;
        return $questions;
    }
}