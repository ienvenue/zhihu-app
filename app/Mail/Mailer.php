<?php

namespace App\Mail;

use Naux\Mail\SendCloudTemplate;
use Illuminate\Support\Facades\Mail;

/**
 * Class Mailer
 * @package App\Mailer
 */
class Mailer
{
    /**
     * @param $template
     * @param $email
     * @param array $data
     */
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