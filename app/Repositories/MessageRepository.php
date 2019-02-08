<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/8
 * Time: 0:00
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::query()->create($attributes);
    }
}