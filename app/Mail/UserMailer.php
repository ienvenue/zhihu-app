<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/4
 * Time: 21:58
 */

namespace App\Mail;


class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => 'zhihu-local.com',
            'name'=>Auth::guard('api')->user()->name
        ];
        $this->sendTo('zhihu_app_user_follow',$email,$data);
    }

    public function passwordReset($email,$token)
    {
        $data = [
            'url' => route('email.verify',$token),
            'name'=>$email->name,
        ];

        $this->sendTo('zhihu_app_password_reset',$email,$data);
    }
    public function welcome(User $user)
    {
        $data = [
            'url'  => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name
        ];
        $this->sendTo('zhihu_app_register', $user->email, $data);
    }
}
