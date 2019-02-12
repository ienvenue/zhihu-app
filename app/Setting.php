<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/12
 * Time: 15:10
 */

namespace App;


class Setting
{

    protected $allowed = ['city','bio'];
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function merge(array $attributes)
    {
        $settings = array_merge($this->user->settings,array_only($attributes,$this->allowed));
        return $this->user->update(['settings' => $settings]);
    }
}