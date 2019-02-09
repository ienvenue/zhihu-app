<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/9
 * Time: 10:36
 */

namespace App\Repositories;


use App\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    public function getTopicsForTagging(Request $request)
    {
        return Topic::select(['id','name'])
            ->where('name','like','%'.$request->query('q').'%')
            ->get();
    }
}