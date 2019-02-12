<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
                'old_password.required' => 'original password can not empty',
                'old_password.min' => 'original password more than 6 byte',
                'password.required' => 'new password can not empty',
                'password.min' => 'new password more than 6 byte',
                'password.confirmed' => 'entering new password twice does not match',

        ];
    }
}
