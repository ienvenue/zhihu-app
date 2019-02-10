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
    public function getAllMessages()
    {
        return Message::query()->where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }, 'toUser'        => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }])->latest()->get();
    }

    public function getDialogMessagesBy($dialogId)
    {
        return Message::query()->where('dialog_id',$dialogId)->with(['fromUser' => function ($query) {
            return $query->select(['id','name','avatar']);
        },'toUser' => function ($query) {
            return $query->select(['id','name','avatar']);
        }])->latest()->get();
    }

    public function getSingleMessageBy($dialogId)
    {
        return Message::query()->where('dialog_id',$dialogId)->first();
    }
}