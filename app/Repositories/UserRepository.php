<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/1/29
 * Time: 23:46
 */

namespace App\Repositories;


use App\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function byId($id)
    {
        return User::query()->findOrFail($id);
    }
}