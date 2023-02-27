<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\Template;
use Symfony\Component\Console\Input\Input;


class UsersRequests extends Template
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
            'first_name' => 'required|min:3|max:33',
            'last_name' => 'required|min:3|max:33',
            'email' => 'required|unique:users',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
            'category' => 'required|min:6',
        ];
    }

}
