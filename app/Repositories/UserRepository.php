<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/1/29
 * Time: 23:46
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::query()->findOrFail($id);
    }
}