<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //override reset password email
    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url(route('password.reset',$token))
        ];
        $template = new SendCloudTemplate('zhihu_app_password_reset ', $data);

        Mail::raw($template, function ($message){
            $message->from('chenyangjieabc@gmail', 'Zhihu-app');

            $message->to($this->email);
        });
    }

}
