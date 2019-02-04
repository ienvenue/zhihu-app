<?php
/**
 * Created by PhpStorm.
 * User: cheny
 * Date: 2019/2/4
 * Time: 21:37
 */

namespace App\Mail;


class Mailer
{
    protected function sendTo($template, $email, array $data)
    {
        $content = new SendCloudTemplate($template, $data);
        Mail::raw($content, function ($message) use ($email) {
            //$message->from('chenyangjieabc@gmail', 'Zhihu-app');
            //bug cannot use from
            $message->to($email);
        });
    }
}