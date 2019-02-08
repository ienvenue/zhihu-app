<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/8
 * Time: 0:00
 */

namespace App\Repositories;


use App\Message;

/**
 * Class MessageRepository
 * @package App\Repositories
 */
class MessageRepository
{
    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return Message::query()->create($attributes);
    }
}