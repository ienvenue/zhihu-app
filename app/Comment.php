<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //多态关联
    protected $table = 'comments';
    protected $fillable = ['user_id','body','commentable_id','commentable_type'];
    public function commentable()
    {
        return $this->morphTo();
    }
    //Comment Model belongsto User Model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
