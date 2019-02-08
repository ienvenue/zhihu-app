<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/8
 * Time: 19:26
 */

namespace App\Repositories;


use App\Comment;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }
}