<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    protected $topic;
    /**
     * TopicsController constructor.
     * @param $topic
     */
    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }
    public function index(Request $request)
    {
        return $this->topic->getTopicsForTagging($request);
    }

    public function show($topicId)
    {
       $topic=$this->topic->showTopicNameby($topicId);
        $question=$this->topic->showQuestionby($topicId);
        return view('topic.show',compact('topic','question'));
    }
}
