<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/1/25
 * Time: 12:29
 */

namespace App\Repositories;

use App\Question;
use App\Topic;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class QuestionRepository
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function byIdWithTopicsAndAnswers($id)
    {
        return Question::query()->where('id', $id)->with(['topics', 'answer'])->first();
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return Question::query()->create($attributes);
    }

    /**
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getQuestionCommentsById($id)
    {
        $question = Question::with('comments', 'comments.user')->where('id', $id)->first();
        return $question->comments;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function byId($id)
    {
        return Question::query()->findOrFail($id);
    }

    /**
     * @param array $topics
     * @return array
     */
    public function normalizeTopics(array $topics)
    {
        return collect($topics)->map(function ($topic) {

            if (is_numeric($topic) && $topic_number = (int)$topic) {
                if ($newTopic = Topic::query()->findOrFail($topic_number)) {
                    $newTopic->increment('questions_count');
                    return $topic_number;
                }

            }

            if ($newTopic = Topic::query()->where('name', $topic)->first()) {
                $newTopic->increment('questions_count');
                return $newTopic->id;
            }

            $newTopic = Topic::query()->create(['name' => $topic, 'questions_count' => 1]);
            return $newTopic->id;
        })->toArray();
    }

}