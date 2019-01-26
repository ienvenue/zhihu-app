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
    public function create(array $attributes)
    {
        return Answer::query()->create($attributes);
    }
}