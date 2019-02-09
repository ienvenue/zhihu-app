<?php
namespace App;


use Illuminate\Database\Eloquent\Collection;

/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/9
 * Time: 19:55
 */
class MessageCollection extends Collection
{
    public function markAsRead()
    {
        $this->each(function($message){
            if($message->to_user_id === user()->id ){
                $message->markAsRead();
            }
        });
    }
}